<?php

namespace ClientsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ObjetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('paysDepart')
        		->add('villeDepart')
        		->add('paysArriver')
        		->add('villeArriver')
        		->add('poids')
        		->add('adresseLivraison')
        		->add('photoObjet')
        		->add('visible')
        		->add('Objets',EntityType::class, array(
            					'class'    => 'ClientsBundle:Clients',
        		    			'choice_label' =>'id',
          						'expanded' => false,
        						'multiple' => false,
        						'required' => false,'label'=>'','attr'=>array('class'=>'')))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClientsBundle\Entity\Objet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'clientsbundle_objet';
    }


}
