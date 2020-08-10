<?php
namespace TransporteursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use UserBundle\Entity\User;
use TransporteursBundle\Entity\Transporteurs;
use TransporteursBundle\Form\TransporteursType;
use TransporteursBundle\Entity\Voyage;
use TransporteursBundle\Form\VoyageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Schema\View;
class TransporteursController extends Controller
{
	public function indexAction( Request $request)
	{
		/*
		 * controle d'acces
		 */
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
	$repository = $this->getDoctrine()->getRepository('TransporteursBundle:Transporteurs');

		$res=$repository->DejaTransporteur($this->getUser()->getId());
		if($res<1)  return $this->redirectToRoute('transporteur');
		//print_r($res);
		$r2=$repository = $this->getDoctrine()
		->getRepository('TransporteursBundle:Transporteurs')
		->IdTransporteur($this->getUser()->getId());
		foreach ($r2 as $key=>$val) $re=$val;
		foreach ($re as $key=>$val) $re2=$val;
		//$result=$this->getTrajet();
		//dump($re);
		
		$user=$this->getUser()->getId();
		$voyage= new Voyage();
		//$voyage->setParcours($this->getTrajet());
		$formV= $this->createForm(VoyageType::class,$voyage)
						->add('Parcours',EntityType::class, array(
				'class'    => 'TransporteursBundle:Transporteurs',
				'choice_label' =>'id',
				'query_builder' => function (EntityRepository $repo) use($re2) {
								return $repo->createQueryBuilder('f')
								->where('f.id = :id')
								->setParameter('id', $re2);
								},
				'expanded' => false,
				'multiple' => false,
				'required' => true,'attr'=>array('value'=>"$re2")))
    	         ->add('Suivant', SubmitType::class,array('attr' =>array("class"=>"btn btn-warning glyphicon ")));
    	            $formV->handleRequest($request);
    	            if (  $formV->isSubmitted() &&  $formV->isValid() )
    	            {
    	            	$em= $this->getDoctrine()->getManager();
    	            	$em->persist($voyage);
    	            	$em->flush();
    	            	//redircted to
					return $this->redirectToRoute('modification_transporteur_voyage');    	            
    	            }
		
		return $this->render('TransporteursBundle:Voyage:Voyage.html.twig',array("form"=> $formV->createView(),'id'=>$re2));
	}
	
	public function transportAction( Request $request)
	{
		/*
		 * controle d'acces
		 */
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		$repository = $this->getDoctrine()->getRepository('TransporteursBundle:Transporteurs');
	
		$r1=$repository->DejaTransporteur($this->getUser()->getId());
		//print_r($r1);
		if($r1==1){    			return $this->redirectToRoute('transporteurs_voyage');
		}else {
			$Transporteur= new Transporteurs();
			$Transporteur->setUser($this->getUser());
			$form= $this->createForm(TransporteursType::class,$Transporteur)
			->add('Suivant', SubmitType::class,array('attr' =>array("class"=>"btn btn-warning glyphicon ")));
			$form->handleRequest($request);
			if (  $form->isSubmitted() &&  $form->isValid() )
			{
				$em= $this->getDoctrine()->getManager();
				$em->persist($Transporteur);
				$em->flush();
				//redircted to
				return $this->render('TransporteursBundle:Voyage:Transporteurs.html.twig', array("form"=> $form->createView()));
	
			}
		}
		return $this->render('TransporteursBundle:Voyage:Transporteurs.html.twig', array("form"=> $form->createView()));
	}
	
	public function editTransporteurAction(Request $request){
		/*
		 * controle d'acces
		 */
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		//
		
		$repository = $this->getDoctrine()
						   ->getRepository('TransporteursBundle:Transporteurs')
						   ->findBy(array("User"=>$this->getUser()->getId()));
		
						   foreach ($repository as $key=> $val ) $id=$val->getId(); 
		//				   dump($id);
		//rechercher des trajets en lien avec le transporteur
		$trajets= $this->getDoctrine()->getManager()
						   ->getRepository('TransporteursBundle:voyage')
						   ->getTransporteurTrajets($id);
		
						   $em= $this->getDoctrine()->getManager();
						   $Transporteur=$em->getRepository('TransporteursBundle:Transporteurs')
						   ->findOneBy(["User"=>$this->getUser()->getId()]);
						   
						   $form= $this->createForm(TransporteursType::class,$Transporteur)
						               ->add('Suivant', SubmitType::class,array('attr' =>array("class"=>"btn btn-warning glyphicon ")));
						   $form->handleRequest($request);
						   if (  $form->isSubmitted() &&  $form->isValid() )
						   {
						   	$em= $this->getDoctrine()->getManager();
						   	$em->persist($Transporteur);
						   	$em->flush();
						   	//redircted to
					return $this->redirectToRoute('modification_transporteur');    	            
						   	
						   }
	return $this->render('TransporteursBundle:Voyage:ApercuVoyage.html.twig', array("form"=> $form->createView(),"profileT"=>$trajets));
						
	}
	
	public function EditVoyageAction(Request $request, $idTV=null)
	{
		
		
		/*
		 * controle d'acces
		 */
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		//
	
		
		
		#récupere les trajets de courant utilisateur 
		
		$repository = $this->getDoctrine()
		->getRepository('TransporteursBundle:Transporteurs')
		->findBy(array("User"=>$this->getUser()->getId()));
		
		foreach ($repository as $key=> $val ) $id=$val->getId();
//		dump($id);
		//rechercher ciblie 
		$trajets= $this->getDoctrine()->getManager()
		->getRepository('TransporteursBundle:voyage')
		->getTransporteurTrajets($id);
		
	
	return $this->render('TransporteursBundle:Voyage:EditVoyage.html.twig', array("profileT"=>$trajets));
			
	}	
	public function EditVoyageIdAction(Request $request, $idTV=null)
	{
		

		
	
		$trajets=null;
		if(isset($idTV)){ 
		$em = $this->getDoctrine()->getManager();
		$voyageId = $em->getRepository('TransporteursBundle:Voyage')->find($idTV);
		
		
		
		$repository = $this->getDoctrine()
		->getRepository('TransporteursBundle:Transporteurs')
		->findBy(array("User"=>$this->getUser()->getId()));
		
		foreach ($repository as $key=> $val ) $id=$val->getId();
		//rechercher des trajets en lien avec le transporteur
		$trajets= $this->getDoctrine()->getManager()
		->getRepository('TransporteursBundle:voyage')
		->getTransporteurTrajets($id);
		
		}else { $voyageId= new voyage();}
		
		$form = $this->createForm(VoyageType::class,$voyageId)
		                      ->add('Valider', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
		
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid())
		{
			$em= $this->getDoctrine()->getManager();
			$em->persist($voyageId);
			$em->flush();
			//return new JsonResponse(array('message' => 'Success!'), 200);
			return $this->redirectToRoute('modification_transporteur_voyage');
		}
		
		
		
		
		
		
		return $this->render('TransporteursBundle:Voyage:EditVoyage.html.twig', array("form"=>$form->createView(),'profileT'=> $trajets));
			
		
	/*	$response = new JsonResponse(
				 $this->renderView('TransporteursBundle:Voyage:EditVoyage.html.twig',
								array(
										'form' => $form->createView(),
										'profileT'=> $trajets
								)));
		$response->headers->set("content-type", "application/json");
		return $response->getContent();*/
	}

	public function suppressionAction( $del)
	{
		if(isset($del)){
			$em = $this->getDoctrine()->getManager();
			$voyageId = $em->getRepository('TransporteursBundle:Voyage')->find($del);
	
			$em= $this->getDoctrine()->getManager();
			$em->remove($voyageId);
			$em->flush();
		
			return $this->redirectToRoute('modification_transporteur_voyage');
		}
		
	}
}