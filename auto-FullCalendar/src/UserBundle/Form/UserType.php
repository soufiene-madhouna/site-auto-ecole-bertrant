<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('prenom',TextType::class,array('label'=>'layout.prenom'))
        	->add('telephone',TextType::class,array('label'=>'layout.telephone'))
        	->add('adresse',TextType::class,array('label'=>'layout.adresse'))  
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }

    public function getParent()
    {
    	return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    	
    	// Or for Symfony < 2.8
    	// return 'fos_user_registration';
    }
    
}
