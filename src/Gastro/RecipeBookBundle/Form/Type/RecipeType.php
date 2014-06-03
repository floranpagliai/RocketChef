<?php
/**
 * RecipeType.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 17:04
 */

namespace Gastro\RecipeBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecipeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('portions', 'integer');
        $builder->add('RecipeIngredient', 'collection', array(
            'type' => new RecipeIngredientType(),
            'allow_add' => true,
            'by_reference' => false
        ));
        $builder->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gastro\DataBundle\Entity\Recipe',
        ));
    }

    public function getName()
    {
        return 'recipe';
    }
} 