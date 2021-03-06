<?php

namespace AppBundle\Controller;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Schema\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\EventCustom;
use AppBundle\Form\EventCustomType;
use DoctrineTest\InstantiatorTestAsset\SerializableArrayObjectAsset;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\NotNull;
use AppBundle\Entity\DateRepos;
use AppBundle\Form\DateReposType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
    	return $this->render('AppBundle:default:index.html.twig');//"event"=>$evenets
    	
    }
    
   /**
    * @Route("/Admin/Event/date/{start}", name="ajax", options = { "expose" = true },)
    * @param Request $request
    * @param unknown $start
    */
    public function ajaxEventAction(Request $request,$start=null)
    {
    	$k=$request->get('start');
    	if ($k)
    	die('s');
    	$output[0]=true;
    	//return var_dump('hello');
    	try {
    		$content = json_encode($output);
    		$status = empty($content) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
    	} catch (\Exception $exception) {
    		$content = json_encode(array('error' => $exception->getMessage()));
    		$status = Response::HTTP_INTERNAL_SERVER_ERROR;
    	}
    	
    	$response = new JsonResponse();
    	$response->headers->set('Content-Type', 'text/json');
    	$response->setContent($content);
    	$response->setStatusCode($status);
    	
    	return $response;
    	
    }
	/**
    * @Route("/Admin/Event", name="Event_creation", options = { "expose" = true },)
	 * @method({"GET", "POST"})
    * @param Request $request
    * @Template("AppBundle:Event:CreationEvent.html.twig",vars={"post"})
    * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    */
	public function creationEventAction(Request $request)
	{
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		//$start=null
		/*if (isset($_GET['start']))die('hello');
		if (isset($_POST['start']))die('dadad');*/
		//$h=$request->request->all();
		$h=$request->isXmlHttpRequest();
		
		$l= $request->getUri();
		dump($l);
		dump($h);
		$k=$request->get('start');
		dump($k);
		$requete=$request->isXmlHttpRequest();
		if(isset($requete)){
			$txt_date1 = $request->get('start');
			if(isset($txt_date1))
				dump($txt_date1);
				
		}
		if( $request->isXmlHttpRequest()) {
			
			die('samjsapjkp');
		}
		
		
		
		$event= new EventCustom();
		
		   	$form= $this->createForm(EventCustomType::class,$event)
    		->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm-5 verification1 ajax")));
    	
    	$form->handleRequest($request);
    	$event->setRdv($this->getUser());
    	
    	if ($form->isSubmitted() && $form->isValid())
    	{	
    		
    		$dateUn = $form["startDate"]->getData();
    		$dateDeux = $form["endDate"]->getData();
    		
    		$dateUn= strtotime($dateUn->format('Y-m-d'));
    		$dateDeux= strtotime($dateDeux->format('Y-m-d'));
    		//echo date_format($date,"Y/m/d H:i:s");
    		$jourUn= date('N',$dateUn);
    		$jourDeux=date('N',$dateDeux);
    		$repository = $this->getDoctrine()->getRepository('AppBundle:DateRepos')->
    		findAll();
    		
    		
    		foreach ( $repository as $value) {
    			
    			if($value->getDate()->format('Y-m-d')==$dateUn ||$value->getDate()->format('Y-m-d')==$dateDeux )
    			{
    				return $this->redirectToRoute('rendez_vous_creation',array("msg"=>$value->getDescription()));
    			}
    			if ( $jourDeux==7 || $jourUn == 7)
    			{
    				return $this->redirectToRoute('rendez_vous_creation',array("msg"=>"jour de repos"));
    				
    			}
    		
    		$em= $this->getDoctrine()->getManager();
    		$em->persist($event);
    		$em->flush();
    		
    		
    		return $this->redirectToRoute('Event_creation');
    		
    	}
    	}
		$evenets= $this->getDoctrine()
    	->getRepository('AppBundle:EventCustom')
    	->findAll();
		
    
    	return $this->render('AppBundle:Event:CreationEvent.html.twig',array("form"=>$form->createView(),));//"event"=>$evenets
	}
   /**
    * @Route("/Admin/Event/load", name="Event_load",
    *       options = { "expose" = true },
    *       )
    * @param Request $request
    * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    */
	
	public function LoadEventAction(Request $request)
	{
	
		
		
		
		$events= $this->getDoctrine()
    	->getRepository('AppBundle:EventCustom')
    	->eventsAvecTitre();
    	//dump($evenets); 
    	
    	//dump($valeurs);
    	//$valeurs= $evenets->unserialize($obj, 'xml');
    	$i=0; 
    	$title="mise � jour par l'administrateur";
    	foreach ($events as $event) {
 
    		$output[$i++] = [
    				"nom"=>strtoupper($event->getRdv()->getUsername()),
    				'id' => $event->getId(),
    				'title' => $event->getTitle()->getType(),
    				'startDate' => $event->getStartDate()->format('Y-m-d H:i '),
    				'endDate' =>  $event->getEndDate()->format('Y-m-d H:i '),
    				'filters' => $event->getFilters(),
    				'event' => $event->getEvents(),
    				'url' => $event->getUrl(),
    				'className' => $event->getClassName(),
    				'editable' => $event->getEditable(),
    				'startEditable' => $event->getStartEditable(),
    				'durationEditable' => $event->getDurationEditable(),
    				'rendering' => $event->getRendering(),
    				'overlap' => $event->getOverlap(),
    				'constraint' => $event->getConstraint(),
    				'source' => $event->getSource(),
    				'color' => $event->getColor(),
    				'backgroundColor' => $event->getBackgroundColor(),
    				'textColor' => $event->getTextColor(),
    				'id' => $event->getId(),
    				'allDay'=>$event->getAllDay(),
    		];
    	}
    	
    	 try {
    	 	$content = json_encode($output);
            $status = empty($content) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        } catch (\Exception $exception) {
            $content = json_encode(array('error' => $exception->getMessage()));
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent($content);
        $response->setStatusCode($status);

        return $response;
    /*
	//json_encode(array('name' => $name))
	$response = new JsonResponse(json_encode(array(
										['events'=> 74]
								)));
		$response->headers->set("content-type", "application/json");
		return $response->getContent();
		*/
    	//return $this->render('AppBundle:Event:CreationEvent.html.twig',array("form"=>$form->createView(),"events"=>$evenets));
	}
	
	/**
	 * @Route("/Admin/Event/gestion", name="Event_gestion")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function gestionEventAction(Request $request)
	{
		
		if (!$this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")) {
			return $this->redirectToRoute('homepage',array("message"=>"acces interdit"));
		}
		
		
		$idU=$this->getUser()->getId();
		$events= $this->getDoctrine()
		->getRepository('AppBundle:EventCustom')
		->findAll();
		return $this->render('AppBundle:Event:AffichageEvent.html.twig',array("events"=>$events));//"event"=>$evenets
		
	}
	
	/**
	 * @Route("/Admin/Event/gestion/{idEv}", name="Event_edition")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function AjourEventAction(Request $request, $idEv=null)
	
	{
		if (!$this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")) {
			return $this->redirectToRoute('homepage',array("message"=>"acces interdit"));
		}
		
		
		if(isset($idEv))
		{
			$events= $this->getDoctrine()
			->getRepository('AppBundle:EventCustom')
			->find($idEv);
		}
		/*if (count($events)>0)
		{*/
			$form = $this->createForm(EventCustomType::class, $events)
			->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
			
			
			$form->handleRequest($request);
			
			if ($form->isValid()) {
				
				$em = $this->getDoctrine()->getManager();
				$em->merge($events);
				$em->flush();
				
				return $this->redirectToRoute('Event_gestion');
			}
		//}
		return $this->render('AppBundle:Event:EditionEvent.html.twig',array("form"=>$form->createView()));
		
	}
	/**
	 *
	 * @param Request $request
	 * @Route("/Admin/Event/supprimer/{idS}", name="event_suppression")
	 * @method({"GET", "POST"})
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function suppressionEventAction(Request $request, $idS=null)
	{
		if (!$this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")) {
			return $this->redirectToRoute('homepage',array("message"=>"acces interdit"));
		}
		
		if(isset($idS))
		{
			print_r($idS);
			$repository = $this->getDoctrine()->getRepository('AppBundle:EventCustom')->
			findOneById($idS);
		}
			if($repository){
			$em = $this->getDoctrine()->getManager();
			$em->remove($repository);
			$em->flush();
			return $this->redirectToRoute('Event_gestion');
			}
			
		else{
			return $this->redirectToRoute('Event_gestion');
		}
			
			
	}
	
	/**
	 *
	 * @param Request $request
	 * @Route("/Admin/Event/validation/{idVd}", name="event_horaire_validation")
	 * @method({"GET", "POST"})
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function validationEventAction(Request $request, $idVd)
	{
		if (!$this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")) {
			return $this->redirectToRoute('homepage',array("message"=>"acces interdit"));
		}
		
		
		if(isset($idVd))
		{
			$repository = $this->getDoctrine()->getRepository('AppBundle:EventCustom')->
			find($idVd);
			$repository->setValider(true);
			$repository->setBackgroundColor('#5CB85C');
			$em = $this->getDoctrine()->getManager();
	//	$em->
			$em->merge($repository);
			$em->flush();
			return $this->redirectToRoute('Event_gestion');
			
			
		}else{
			return $this->redirectToRoute('Event_gestion');}
			
			
	}
	
	/**
	 * @Route("/Eleve/Rendezvous", name="rendez_vous_creation")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function rendezVousAction(Request $request)
	{
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		$event= new EventCustom();
		
		
		$form= $this->createForm(EventCustomType::class,$event)
		->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm-5 verification1 ajax")));
		
		$form->handleRequest($request);
		$event->setRdv($this->getUser());
		
		//$test=$request->request->get('startDate');
		
		//getFormDataArray($form);
		
		if ($form->isSubmitted() && $form->isValid())
		{
			//$username = $form["startDate"]->getData();
			
			$dateUn = $form["startDate"]->getData();
			$dateDeux = $form["endDate"]->getData();
			
			$dateUn= strtotime($dateUn->format('Y-m-d'));
			$dateDeux= strtotime($dateDeux->format('Y-m-d'));
			//echo date_format($date,"Y/m/d H:i:s");
			$jourUn= date('N',$dateUn);
			$jourDeux=date('N',$dateDeux);
			$repository = $this->getDoctrine()->getRepository('AppBundle:DateRepos')->
			findAll();
			
			
			foreach ( $repository as $value) {
				
				if($value->getDate()->format('Y-m-d')==$dateUn ||$value->getDate()->format('Y-m-d')==$dateDeux )
				{
					return $this->redirectToRoute('rendez_vous_creation',array("msg"=>$value->getDescription()));
				}
				if ( $jourDeux==7 || $jourUn == 7)
				{
					return $this->redirectToRoute('rendez_vous_creation',array("msg"=>"jour de repos"));
					
				}
			}
			//dump($username->format('Y-m-d'));
			$em= $this->getDoctrine()->getManager();
			$em->persist($event);
			$em->flush();
			
			
			return $this->redirectToRoute('rendez_vous_creation');
			
		}
		$evenets= $this->getDoctrine()
		->getRepository('AppBundle:EventCustom')
		->findAll();
		
		
		return $this->render('AppBundle:Event:EleveEven.html.twig',array("form"=>$form->createView(),));//"event"=>$evenets
		
	}
	
	
	
	protected function FormDataArray($form)
	{
		$dateUn = $form["startDate"]->getData();
		$dateDeux = $form["endDate"]->getData();
		
		$dateUn= $dateUn->format('Y-m-d');
		$dateDeux= $dateDeux->format('Y-m-d');
		
		$repository = $this->getDoctrine()->getRepository('AppBundle:DateRepos')->
		findAll();
		
		
		foreach ( $repository as $value) {
			if($value->getDate()->format('Y-m-d')==$dateUn ||$value->getDate()->format('Y-m-d')==$dateDeux)
				return $this->redirectToRoute('rendez_vous_creation',array("msg"=>$value->getDescription()));
				
		}
		return $this->redirectToRoute('rendez_vous_creation');
	}
	
	
	
	/**
	 * @Route("/Eleve/Rendezvous/{edRdv}", name="rendez_vous_edition")
	 * @method({"GET", "POST"})
	 * @param Request $request
	 */
	public function editionRendezVousAction(Request $request,$edRdv=null)
	{
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		if(isset($_GET['edRdv'])) die("hello coucou");
		if (isset($edRdv))
		{
			$id=$this->getUser()->getId();
			$event= $this->getDoctrine()->getManager()
			->getRepository('AppBundle:EventCustom')
			//->utilisateurEvent($id,$edRdv);
			->findOneBy(["rdv"=>$id,"id"=>$edRdv,'valider'=>false]);
			
		}if(!$event) {					return $this->redirectToRoute('rendez_vous_creation');
		
			
		}
		$form= $this->createForm(EventCustomType::class,$event)
		->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm-5 verification1 ajax")));
		
		$form->handleRequest($request);
		
			if ($form->isSubmitted() && $form->isValid())
			{
				$dateUn = $form["startDate"]->getData();
				$dateDeux = $form["endDate"]->getData();
				
				$dateUn= strtotime($dateUn->format('Y-m-d'));
				$dateDeux= strtotime($dateDeux->format('Y-m-d'));
				//echo date_format($date,"Y/m/d H:i:s");
				$jourUn= date('N',$dateUn);
				$jourDeux=date('N',$dateDeux);
				$repository = $this->getDoctrine()->getRepository('AppBundle:DateRepos')->
				findAll();
				
				
				foreach ( $repository as $value) {
					
					if($value->getDate()->format('Y-m-d')==$dateUn ||$value->getDate()->format('Y-m-d')==$dateDeux )
					{
						return $this->redirectToRoute('rendez_vous_creation',array("msg"=>$value->getDescription()));
					}
					if ( $jourDeux==7 || $jourUn == 7)
					{
						return $this->redirectToRoute('rendez_vous_creation',array("msg"=>"jour de repos"));
						
					}
				}	
				
				$em= $this->getDoctrine()->getManager();
				$em->persist($event);
				$em->flush();
				
				
				return $this->redirectToRoute('rendez_vous_creation');
				
			}
		
		
		return $this->render('AppBundle:Event:ModificationEvent.html.twig',array("form"=>$form->createView(),));//"event"=>$evenets
					
	}
	
	
	/**
	 * @Route("/Eleve/Rendezvous/historique", name="rendez_vous_historique")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function historiqueRendezVousAction(Request $request)
	{
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		$id=$this->getUser()->getId();
		
		$events= $this->getDoctrine()->getManager()
		->getRepository('AppBundle:EventCustom')
		//->utilisateurEvent($id,$edRdv);
		->findBy(["rdv"=>$id]);
		dump($events);
		
		
		return $this->render('AppBundle:Event:HistoriqueEvent.html.twig',array("historique"=>$events,));//"event"=>$evenets
		
	}
	
	/**
	 * @Route("/Eleve/Rendezvous/suppresion/{idS}", name="rendez_vous_supression")
	 * @method({"GET", "POST"})
	 * @param Request $request
	 * @param unknown $idS
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function suppressionRendezVousAction(Request $request, $idS=null)
	{
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		
		if(isset($idS))
		{
			$id=$this->getUser()->getId();
			$repository = $this->getDoctrine()->getRepository('AppBundle:EventCustom')->
			findOneById(["rdv"=>$id,"id"=>$idS]);
		}
		if($repository){
			$em = $this->getDoctrine()->getManager();
			$em->remove($repository);
			$em->flush();
			return $this->redirectToRoute('rendez_vous_creation',array("supp"=>true));
		}
		
		else{
			return $this->redirectToRoute('rendez_vous_creation');
		}
		
		
	}

}