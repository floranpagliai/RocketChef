<?php
/**
 * RecipeIngredientType.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 17:01
 */

namespace RocketChef\DataBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use RocketChef\DataBundle\Entity\RecipeIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class RecipeIngredientType extends AbstractType
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
            function (FormEvent $event) use ($restaurant) {
                $form = $event->getForm();
                $ingredient = $event->getData();
                $formOptions = array(
                    'empty_value'   => 'Choose an option',
                    'class'         => 'RocketChef\DataBundle\Entity\Ingredient',
                    'property'      => 'name',
                    'query_builder' => function (EntityRepository $er) use ($restaurant) {
                        return $er->createQueryBuilder('i')->where('i.restaurant = :restaurant')->setParameter('restaurant', $restaurant);
                    },
                );
                if ($ingredient) {
                    $form->add('ingredient', new IngredientType());
                } else
                    $form->add('ingredient', 'entity', $formOptions);
            }
        );
        $builder->add('qte', 'number');
        $builder->add('unit', 'choice', array(
            'choices' => array(
                RecipeIngredient::UNIT_UNITARY => 'Unité',
                RecipeIngredient::UNIT_GR      => 'Gr',
                RecipeIngredient::UNIT_KG      => 'Kg',
                RecipeIngredient::UNIT_CLITER  => 'Cl',
                RecipeIngredient::UNIT_LITER   => 'L'
            )
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'    => 'RocketChef\DataBundle\Entity\RecipeIngredient',
            'error_mapping' => array(
                'valid' => 'unit'),
        ));
    }

    public function getName()
    {
        return 'recipeIngredient';
    }
} 