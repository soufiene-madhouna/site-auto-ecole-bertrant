<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\PlageHoraire;
use AppBundle\Form\PlageHoraireType;
use Symfony\Component\BrowserKit\Response;
class PlageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
    	return $this->render('AppBundle:PlageHoraire:AffichagePlage.html.twig');
    	
    }
   /**
    * @Route("/Admin/plageHoraire", name="plage_horaire_creation")
    * @param Request $request
    * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    */
    public function creationPlageAction(Request $request)
    {
    	if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
    		throw $this->createAccessDeniedException();
    	}
    	
    	$plageH= new PlageHoraire();
    	
    	$form= $this->createForm(PlageHoraireType::class,$plageH)
    	->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
    	
    	$form->handleRequest($request);
    	
    	if ($form->isSubmitted() && $form->isValid())
    	{
    		$em= $this->getDoctrine()->getManager();
    		$em->persist($plageH);
    		$em->flush();
    		return $this->redirectToRoute('plage_horaire_creation');
    	}
    	
    	$plagesH =  $this->getDoctrine()
    	->getRepository('AppBundle:PlageHoraire')
    	->findAll();
    	
    	return $this->render('AppBundle:PlageHoraire:CreationPlage.html.twig',array("form"=>$form->createView(),"horaires"=>$plagesH));
    	
    }
    
    /**
     * @Route("/Admin/plageHoraire/{idH}", name="edition_plage_horaire")
     * @method({"GET", "POST"})
     * @param Request $request
     */
    public function editionPlageHoraireAction(Request $request, $idH=null)
    {
    	if (!$this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")) {
    		return $this->redirectToRoute('homepage',array("message"=>"acces interdit"));
    	}
    	
    	
    	$Edit=null;
    	if (isset($idH))
    	{
    		print_r($idH);
    		$Edit = $this->getDoctrine()
    		->getRepository('AppBundle:PlageHoraire')
    		->findOneById($idH);
    		dump($Edit);
    		print_r($Edit->getDebut());
    		$form= $this->createForm(PlageHoraireType::class,$Edit)
    			->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
    			
    			$form->handleRequest($request);
    			
    			if ($form->isSubmitted() && $form->isValid())
    			{
    				return $this->redirectToRoute('plage_horaire_creation');
    				
    				$em= $this->getDoctrine()->getManager();
    				$name_value = $request->request->get('type');
    				print_r($name_value);
    				$em->detach($Edit);
    				$em->merge($Edit);
    				$em->flush();
    				
    				
    				return $this->redirectToRoute('plage_horaire_creation');
    				
    			}
    		
    		
    	}
    	return $this->render('AppBundle:PlageHoraire:EditionPlage.html.twig',array("form"=>$form->createView()));
    	
    }
    
    
    /**
     * 
     * @param Request $request
     * @Route("/Admin/plageHoraire/supprimer/{supp}", name="plage_horaire_suppression")
     * @method({"GET", "POST"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function suppressionPlageHoraireAction(Request $request, $supp=null)
    {
    	
    	if (!$this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")) {
    		return $this->redirectToRoute('homepage',array("message"=>"acces interdit"));
    	}
    	
    	//$supp = $_GET['supp'];
    	
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
