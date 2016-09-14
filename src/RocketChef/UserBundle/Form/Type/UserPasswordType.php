<?php
/**
 * UserPasswordType.php
 * User: Utilisateur
 * Date: 11/06/14
 * Time: 11:16
 */

namespace RocketChef\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserPasswordType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('plain_password', 'repeated', array(
            'type'            => 'password',
            'invalid_message' => 'Les mots de passe doivent correspondre',
            'first_options'   => array('label' => 'Mot de passe'),
            'second_options'  => array('label' => 'Mot de passe (validation)'),
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RocketChef\UserBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'user_password';
    }
}