<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\PlageHoraire;
use AppBundle\Form\PlageHoraireType;
use Symfony\Component\BrowserKit\Response;

class horairePlageController extends Controller
{
	public function indexAction(Request $request)
	{	
		return $this->render('admin/index.html.twig');
	}
	public function creationPlageAction(Request $request, $idEdit=null)
	{
		if ($idEdit== null)
		{	
			$horaires= new PlageHoraire();
	}else 	{$horaires= $this->getDoctrine()
			->getRepository('AppBundle:PlageHoraire')
			->find($idEdit);
			}
			$form = $this->createForm(PlageHoraireType::class, $horaires)
			->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
			
			
			$form->handleRequest($request);
			/*$ki=$request->getType();
			print_r($ki);*/
			if ($form->isValid()) {
				
				$em = $this->getDoctrine()->getManager();
				$em->merge($horaires);
				$em->flush();
				
				return $this->redirectToRoute('plage_horaire_creation');
			}
			
			$plagesH =  $this->getDoctrine()
			->getRepository('AppBundle:PlageHoraire')
			->findAll();
			if ($idEdit== null)
				return $this->render('AppBundle:PlageHoraire:CreationPlage.html.twig',array("form"=>$form->createView(),"horaires"=>$plagesH));
				else 	return $this->render('AppBundle:PlageHoraire:EditionPlage.html.twig',array("form"=>$form->createView(),"horaires"=>$plagesH));
	}
	
	public function suppressionPlageHoraireAction(Request $request, $supp=null)
	{
		
		if (!$this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")) {
			return $this->redirectToRoute('homepage',array("message"=>"acces interdit"));
		}
		
		$supp = $_GET['supp'];
		
		if(isset($supp))
		{
			$repository = $this->getDoctrine()->getRepository('AppBundle:PlageHoraire')->
			find($supp);
			dump($repository);
			
			$em = $this->getDoctrine()->getManager();
			$em->remove($repository);
			$em->flush();
			return $this->redirectToRoute('plage_horaire_creation');
			
			
		}else{
			return $this->redirectToRoute('plage_horaire_creation');}
			
	}
}
