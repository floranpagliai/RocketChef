<?php
/**
 * UserPasswordType.php
 * User: Utilisateur
 * Date: 11/06/14
 * Time: 11:16
 */

namespace Gastro\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserPasswordType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', 'password');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gastro\UserBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'user_password';
    }
}