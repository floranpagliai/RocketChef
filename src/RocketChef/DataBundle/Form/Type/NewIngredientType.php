<?php
/**
 * NewIngredientType.php
 * User: floran.pagliai
 * Date: 01/07/14
 * Time: 11:49
 */

namespace RocketChef\DataBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewIngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('priceForUnit', 'money');
        $builder->add('unit', 'choice', array('choices' => array(0 => '/Unité', 1 => '/Kg', 2 => '/L')));
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