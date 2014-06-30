<?php
/**
 * IngredientType.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 16:59
 */

namespace RocketChef\RecipeBookBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class IngredientType extends AbstractType
{
    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $restaurant = $this->securityContext->getToken()->getUser()->getRestaurant();

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($restaurant) {
                $form = $event->getForm();
                $ingredient = $event->getData();

                $formOptions = array(
                    'empty_value' => 'Choose an option',
                    'class' => 'RocketChef\DataBundle\Entity\Ingredient',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) use ($restaurant) {
                            return $er->createQueryBuilder('i');
                        },
                );

                $formOptions2 = array(
                    'empty_value' => $ingredient,
                    'class' => 'RocketChef\DataBundle\Entity\Ingredient',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er) use ($restaurant) {
                            return $er->createQueryBuilder('i');
                        },
                );

                if (!$ingredient) {
                    $form->add('name', 'entity', $formOptions);
                } else
                    $form->add('name', 'entity', $formOptions2);
            }
        );

        //$builder->add('name');
        //$builder->add('priceForUnit', 'money');
        //$builder->add('unit', 'choice', array( 'choices'   => array(0 => '/Unité', 1 => '/Kg', 2 => '/L')));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RocketChef\DataBundle\Entity\Ingredient',
        ));
    }

    public function getName()
    {
        return 'ingredient';
    }
} 