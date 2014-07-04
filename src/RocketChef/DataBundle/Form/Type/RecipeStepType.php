<?php
/**
 * RecipeStepType.php
 * User: floran.pagliai
 * Date: 04/07/14
 * Time: 12:12
 */

namespace RocketChef\DataBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecipeStepType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RocketChef\DataBundle\Entity\RecipeIngredient',
        ));
    }

    public function getName()
    {
        return 'recipeStep';
    }
}