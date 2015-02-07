<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            //->add('password') //don't want to see this with editing, only creation
            ->add('roles', 'entity', array(
                    'multiple'      => true,
                    'expanded'      => true,
                    'class' => 'AppBundle:Role',
                    'property' => 'name',
//                    'error_bubbling' => true,
//                    'required' => true,
                ))
            ->add('email','email');

//            ->add('videos'); get blank page when this is on

        //only show the password field if creating a new user
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $user = $event->getData();
                $form = $event->getForm();

                // check if the Product object is "new"
                // If no data is passed to the form, the data is "null".
                // This should be considered a new "Product"
                if (!$user || null === $user->getId()) {
                    $form->add('password', 'text');
                }
            });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_user';
    }
}
