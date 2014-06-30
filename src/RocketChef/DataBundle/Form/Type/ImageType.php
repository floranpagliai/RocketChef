<?php
/**
 * ImageType.php
 * User: Utilisateur
 * Date: 05/06/14
 * Time: 13:49
 */

namespace RocketChef\DataBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('image', 'file');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RocketChef\DataBundle\Entity\Image',
        ));
    }

    public function getName()
    {
        return 'image';
    }
} 