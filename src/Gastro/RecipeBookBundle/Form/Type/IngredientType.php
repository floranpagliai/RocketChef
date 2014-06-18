<?php
/**
 * IngredientType.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 16:59
 */

namespace Gastro\RecipeBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
        $builder->add('name');
        $builder->add('priceForUnit', 'money');
        $builder->add('unit', 'choice', array( 'choices'   => array(0 => '/Unité', 1 => '/Kg', 2 => '/L')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gastro\DataBundle\Entity\Ingredient',
        ));
    }

    public function getName()
    {
        return 'ingredient';
    }
} 