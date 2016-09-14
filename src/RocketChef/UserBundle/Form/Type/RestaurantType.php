<?php
/**
 * User: floran
 * Date: 19/06/2014
 * Time: 22:23
 */

namespace RocketChef\UserBundle\Form\Type;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RestaurantType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $formOptions = array(
                    'class'         => 'RocketChef\UserBundle\Entity\Subscription',
                    'property'      => 'name',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('i');
                    },
                );
                $form->add('subscription', 'entity', $formOptions);

            }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RocketChef\UserBundle\Entity\Restaurant',
        ));
    }

    public function getName()
    {
        return 'restaurant';
    }
}