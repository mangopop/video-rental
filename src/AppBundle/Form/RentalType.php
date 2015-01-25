<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Form\UserToIdTransformer;
use AppBundle\Entity\User;

class RentalType extends AbstractType
{

    protected $user;

    public function __construct (User $user=null)
    {
        $this->user = $user;
        //var_dump($user);
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // this assumes that the entity manager was passed in as an option
        $entityManager = $options['em'];
        $transformer = new UserToIdTransformer($entityManager);
        //$user = $options['User'];


        $builder
            //->add('user', 'hidden', array('data'=>'1'))
            ->add('video', 'entity', array(
                    //'multiple'      => true,
                    //'expanded'      => true,
                    'class' => 'AppBundle:Video',
                    'property' => 'title',
//                    'error_bubbling' => true,
//                    'required' => true,
                ))
            ->add('out_date', 'date',array('widget' => 'single_text'))
            ->add('arranged_days_rented', 'integer')
            ->add('actual_days_rented', 'integer')
            //->add('save', 'submit', array('label' => 'Add video(s)')) //shouldn't put this there
        ;

        // add a normal text field, but add your transformer to it
        $builder->add(
            $builder->create('user', 'hidden') //can't call getid when default data is used
                //this seems to try and transform if we add a value before submit
                ->addModelTransformer($transformer)//transforms to a string/norm to model AND vice versa
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Rentals'
        ))
        ->setRequired(array(
            'em',
        ))
        ->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_rental';
    }
}
