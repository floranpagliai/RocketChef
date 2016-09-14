<?php
/**
 * RecipeType.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 17:04
 */

namespace RocketChef\DataBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class RecipeType extends AbstractType
{

    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event)  {
                $form = $event->getForm();
                $formOptions = array(
                    'class' => 'RocketChef\DataBundle\Entity\RecipeType',
                    'property' => 'name',
                    'query_builder' => function(EntityRepository $er)  {
                            return $er->createQueryBuilder('i');
                        },
                );
                $form->add('type', 'entity', $formOptions);

            }
        );
        $builder->add('portions', 'number');
        $builder->add('price', 'money');
        $builder->add('image', new ImageType(), array('required' => false));
        $builder->add('RecipeIngredient', 'collection', array(
            'type' => new RecipeIngredientType($this->securityContext),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'by_reference' => false
        ));
        $builder->add('RecipeStep', 'collection', array(
            'type' => new RecipeStepType(),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'by_reference' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RocketChef\DataBundle\Entity\Recipe',
        ));
    }

    public function getName()
    {
        return 'recipe';
    }
} 