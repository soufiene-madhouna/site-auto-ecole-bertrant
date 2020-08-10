<?php

namespace TransporteursBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class VoyageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateAller',TimeType::class)
        		->add('paysDepart')
        		->add('villeDepart')
        		->add('paysArriver')
        		->add('villeArriver')
        		->add('commander')
        		->add('dateRetoure',DateType::class,array('widget' => 'single_text', 'input' => 'datetime', 'format' => 'dd-MM-y',
'required' => false,))
        		->add('Parcours',EntityType::class, array(
            					'class'    => 'TransporteursBundle:Transporteurs',
        		    			'choice_label' =>'id',
          						'expanded' => false,
        						'multiple' => false,
        						'required' => false,'label'=>'','attr'=>array('class'=>'')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TransporteursBundle\Entity\Voyage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'transporteursbundle_voyage';
    }


}
