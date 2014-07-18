<?php
/**
 * SellingDayRecipeType.php
 * User: floran.pagliai
 * Date: 18/07/14
 * Time: 15:25
 */

namespace RocketChef\DataBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class SellingDayRecipeType extends AbstractType
{
    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('qte', 'text');
        $restaurant = $this->securityContext->getToken()->getUser()->getRestaurant();
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($restaurant) {
                $form = $event->getForm();
                $recipe = $event->getData();
                $formOptions = array(
                    'empty_value' => 'Choose an option',
                    'class' => 'RocketChef\DataBundle\Entity\Recipe',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) use ($restaurant) {
                            return $er->createQueryBuilder('i')->where('i.restaurant = :restaurant')->setParameter('restaurant', $restaurant);
                        },
                );
                if (!$recipe) {
                    $form->add('recipe', 'entity', $formOptions);
                }

            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RocketChef\DataBundle\Entity\SellingDayRecipe',
        ));
    }

    public function getName()
    {
        return 'sellingDayRecipe';
    }
}