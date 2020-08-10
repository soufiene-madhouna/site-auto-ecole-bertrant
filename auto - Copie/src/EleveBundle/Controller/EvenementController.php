<?php

namespace EleveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use EleveBundle\Entity\Evenement;
use EleveBundle\Form\EvenementType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class EvenementController extends Controller
{
    public function indexAction()
    {
        return $this->render('EleveBundle:Default:index.html.twig');
    }
    
    
    public function creationEventAction(Request $request)
    {
    	if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
    		throw $this->createAccessDeniedException();
    	}
    	
    	$event= new Evenement();
    	$repository = $this->getDoctrine()->getRepository('AppBundle:PlageHoraire')->
    	getTypePlage();
    	dump($repository);
    	$form= $this->createForm(EvenementType::class,$event)
    	->add('typeEvenement', EntityType::class, array(
    			'class' => 'AppBundle:PlageHoraire',
    			'choice_label' => $repository->getType(),
    			))
    	->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
    	
    	$form->handleRequest($request);
    	
    	if ($form->isSubmitted() && $form->isValid())
    	{
    		$em= $this->getDoctrine()->getManager();
    		$em->persist($event);
    		$em->flush();
    		
    		
    		return $this->redirectToRoute('evenement_creation');
    		
    	}
    	return $this->render('EleveBundle:Evenement:CreationEvenement.html.twig',array("form"=>$form->createView()));
    	
    }
}
