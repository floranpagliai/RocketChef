<?php
/**
 * IngredientType.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 16:59
 */

namespace RocketChef\DataBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('read_only' => true));
        $builder->add('priceForUnit', 'money', array('read_only' => true));
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