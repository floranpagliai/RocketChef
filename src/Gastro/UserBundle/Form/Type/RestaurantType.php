<?php
/**
 * User: floran
 * Date: 19/06/2014
 * Time: 22:23
 */

namespace Gastro\UserBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RestaurantType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gastro\UserBundle\Entity\Restaurant',
        ));
    }

    public function getName()
    {
        return 'restaurant';
    }
}