<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PlageHoraireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type',TextType::class,array('label'=>'PlageHoraire.type'))
        ->add('debut',DateTimeType::class,array('label'=>'PlageHoraire.debut','widget' => 'single_text',  'attr' => ['class' => 'datetimepicker  form-control col-md-3'],'format' => 'dd/MM/yyyy H:i:s',))
        ->add('fin',DateTimeType::class,array('label'=>'PlageHoraire.fin','widget' => 'single_text',  'attr' => ['class' => 'datetimepicker  form-control col-md-3'],'format' => 'dd/MM/yyyy H:i:s',))
        ->add('details',TextareaType::class,array('label'=>'PlageHoraire.details'))
        	;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PlageHoraire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_plagehoraire';
    }


}
