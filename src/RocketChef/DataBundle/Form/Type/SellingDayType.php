<?php
/**
 * SellingDayType.php
 * User: floran.pagliai
 * Date: 18/07/14
 * Time: 15:20
 */

namespace RocketChef\DataBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class SellingDayType extends AbstractType
{
    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', 'date', array('data' => new \DateTime('today')));
        $builder->add('recipes', 'collection', array(
            'type' => new SellingDayRecipeType($this->securityContext),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'by_reference' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RocketChef\DataBundle\Entity\SellingDay',
        ));
    }

    public function getName()
    {
        return 'sellingDay';
    }
} 