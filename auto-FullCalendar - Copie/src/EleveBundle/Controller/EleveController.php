<?php

namespace EleveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use userBundle\Entity\User;
use EleveBundle\Entity\Eleve;
use EleveBundle\Form\EleveType;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends Controller
{
    public function affichageEleveAction()
    {
        return $this->render('EleveBundle:Eleve:affichage.html.twig');
    }
    
    public function creationEleveAction(Request $request)
    {
    	
    	$eleve= new Eleve();
    	$form= $this->createForm(EleveType::class,$eleve)
    		->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
    	
    	$form->handleRequest($request);
    	
    	$idUtilisateur= $this->getUser()->getId();
    	//on vérifie si notre eleve a rensignier les champs de la table élève
    	
    	$repository = $this->getDoctrine()->getRepository('EleveBundle:Eleve')
    		->findOneBy(["utilisateur"=>$this->getUser()->getId()]);
    	
    	//
    	if($repository != null) return $this->redirectToRoute('homepage');
    	
    	
    	if ($form->isSubmitted() && $form->isValid())
    	{
    		$em= $this->getDoctrine()->getManager();
    		$em->persist($eleve);
    		$em->flush();
    		
    		
    		return $this->redirectToRoute('homepage');
    		
    	}
    	
    	return $this->render('EleveBundle:Eleve:CreationEleve.html.twig',array("form"=>$form->createView()));
    
    }
    
    public function editionEleveAction(Request $request)
    {
      	if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
    		throw $this->createAccessDeniedException();
    	}
    	
    	$idUtilisateur= $this->getUser()->getId();
      	$repository = $this->getDoctrine()->getRepository('EleveBundle:Eleve')->
      	findOneBy(["utilisateur"=>$this->getUser()->getId()]);
      	//findBy(["utilisateur"=>$idUtilisateur]);
      	if($repository != null)
      	{
      		$form= $this->createForm(EleveType::class,$repository)
      		->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
      		
      		$form->handleRequest($request);
      		
      		if ($form->isSubmitted() && $form->isValid())
      		{
      			$em= $this->getDoctrine()->getManager();
      			$em->persist($repository);
      			$em->flush();
      			
      			return $this->redirectToRoute('eleve_affichage');
      			
      		}
      		
      		
      	}
      	return $this->render('EleveBundle:Eleve:EditionEleve.html.twig',array("form"=>$form->createView(),"eleve"=>$repository));
      	
    }
    
    public function suppressionEleveAction(Request $request, $id)
    {
    	if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
    		throw $this->createAccessDeniedException();
    	}
    	
    	
    	$utilisateurConnecter= $this->getUser()->getId();
    	if (isset($id) && $id== $utilisateurConnecter)
    	{
    		$repository = $this->getDoctrine()->getRepository('UserBundle:User')->
    		findOneById($id);
    		
    		$em = $this->getDoctrine()->getManager();
    		$em->remove($repository);
    		$em->flush();
    		return $this->redirectToRoute('homepage');
    		
    	}else {
    		return $this->redirectToRoute('eleve_edition', array("invalide informations"));
    		
    	}
    }
}
