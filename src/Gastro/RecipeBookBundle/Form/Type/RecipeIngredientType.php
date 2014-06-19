<?php
/**
 * RecipeIngredientType.php
 * User: Utilisateur
 * Date: 02/06/14
 * Time: 17:01
 */

namespace Gastro\RecipeBookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
        $builder->add('ingredient', new IngredientType($this->securityContext));
        $builder->add('qte', 'number');
        $builder->add('unit', 'choice', array( 'choices'   => array(0 => 'Unité', 3 => 'Gr', 1 => 'Kg', 4 => 'Cl', 2 => 'L')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gastro\DataBundle\Entity\RecipeIngredient',
        ));
    }

    public function getName()
    {
        return 'recipeIngredient';
    }
} 