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
use AppBundle\Entity\DateRepos;
use AppBundle\Form\DateReposType;

use AppBundle\Form\EventCustomType;
use DoctrineTest\InstantiatorTestAsset\SerializableArrayObjectAsset;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\NotNull;


class DateReposController extends Controller
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
    * @Route("/Admin/date/creation", name="date_repos_creation")
    * @param Request $request
    * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    */
	public function creationDateReposAction(Request $request)
	{
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		
		$date= new DateRepos();
		
		$form= $this->createForm(DateReposType::class,$date)
    		->add('Sauvegarder', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
    	
    	$form->handleRequest($request);
    	
    	if ($form->isSubmitted() && $form->isValid())
    	{	
    		
    		$em= $this->getDoctrine()->getManager();
    		$em->persist($date);
    		$em->flush();
    		
    		
    		return $this->redirectToRoute('date_repos_creation');
    		
    	}
		/*$evenets= $this->getDoctrine()
    	->getRepository('AppBundle:DateRepos')
    	->findAll();*/
		
    
    	return $this->render('AppBundle:DateRepos:CreationDateRepos.html.twig',array("form"=>$form->createView(),));//"event"=>$evenets
	}
	
	/**
	 * @Route("/Admin/date/repos/load", name="date_repos_load",
	 *       options = { "expose" = true },
	 *       )
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	
	public function LoadEventAction(Request $request)
	{
		
		$date= $this->getDoctrine()
		->getRepository('AppBundle:DateRepos')
		->findAll();
		//dump($date);
		
		//dump($valeurs);
		//$valeurs= $evenets->unserialize($obj, 'xml');
		$i=0;
		$title="mise à jour par l'administrateur";
		foreach ($date as $dt) {
			
			$output[$i++] = [
					"id" => $dt->getId(),
					"date" => $dt->getDate()->format('Y-m-d'),
					"descritpion" => $dt->getDescription()
					
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
	
   
}
