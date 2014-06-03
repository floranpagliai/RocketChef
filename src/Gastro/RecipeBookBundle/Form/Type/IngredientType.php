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

class IngredientType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('priceForUnit', 'money');
        $builder->add('unit');
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