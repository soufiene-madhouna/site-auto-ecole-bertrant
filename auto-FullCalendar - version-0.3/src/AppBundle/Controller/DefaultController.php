<?php

namespace AppBundle\Controller;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Schema\View;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\EventCustom;
use AppBundle\Form\EventCustomType;
use DoctrineTest\InstantiatorTestAsset\SerializableArrayObjectAsset;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\NotNull;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
	/**
    * @Route("/Admin/Event", name="Event_creation")
    * @param Request $request
    * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    */
	public function creationEventAction(Request $request)
	{
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		
		$event= new EventCustom();
		
		   	$form= $this->createForm(EventCustomType::class,$event)
    		->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
    	
    	$form->handleRequest($request);
    	$event->setRdv($this->getUser());
    	
    	if ($form->isSubmitted() && $form->isValid())
    	{	
    		
    		$em= $this->getDoctrine()->getManager();
    		$em->persist($event);
    		$em->flush();
    		
    		
    		return $this->redirectToRoute('Event_creation');
    		
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
    	$title="mise à jour par l'administrateur";
    	foreach ($events as $event) {
 
    		$output[$i++] = [
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
}
