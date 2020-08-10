<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EventCustomType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder->add('title',EntityType::class, array(
    			'class'    => 'AppBundle:PlageHoraire',
    			'choice_label' =>'type',
    			'expanded' => false,
    			'multiple' => false,
    			'required' => true,'label'=>'Titre','attr' => ['class' => 'formTexte']))
        		->add('allDay')
        		->add('startDate',DateTimeType::class,array('label'=>'Début date/heurs','widget' => 'single_text','widget' => 'single_text','attr' => ['class' => 'datetimepicker'],'format' => 'dd/MM/yyyy H:i:s',))
        		->add('endDate',DateTimeType::class,array('label'=>'Fin date/heurs','widget' => 'single_text',  'attr' => ['class' => 'datetimepicker'],'format' => 'dd/MM/yyyy H:i:s',))
    	;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EventCustom'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_eventcustom';
    }


}
