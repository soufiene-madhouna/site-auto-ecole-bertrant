<?php

namespace ClientsBundle\Controller;

use ClientsBundle\Entity\Objet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use ClientsBundle\Form\ObjetType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Objet controller.
 *
 * @Route("objet")
 */
class ObjetController extends Controller
{
    /**
     * Lists all objet entities.
     *
     * @Route("/", name="objet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $objets = $em->getRepository('ClientsBundle:Objet')->findAll();

        return $this->render('ClientsBundle:objet:index.html.twig', array(
            'objets' => $objets,
        ));
    }

    /**
     * Creates a new objet entity.
     *
     * @Route("/nouveau", name="objet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $objet = new Objet();
        $form = $this->createForm(objetType::class, $objet)
        ->add('Objets',EntityType::class, array(
            					'class'    => 'ClientsBundle:Clients',
        		    			'choice_label' =>'id',
          						'expanded' => false,
        						'multiple' => false,
        						'required' => false,'label'=>'','attr'=>array('class'=>''))) 
		->add('Valider', SubmitType::class,array('attr' =>array("class"=>"btn btn-success btn-sm")));
        						;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($objet);
            $em->flush($objet);
		print_r("hello");
            return $this->redirectToRoute('objet_show', array('id' => $objet->getId()));
        }

        return $this->render('ClientsBundle:objet:nouveau.html.twig', array(
            'objet' => $objet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a objet entity.
     *
     * @Route("/{id}", name="objet_show")
     * @Method("GET")
     */
    public function showAction(Objet $objet)
    {
        $deleteForm = $this->createDeleteForm($objet);

        return $this->render('ClientsBundle:objet:afficher.html.twig', array(
            'objet' => $objet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing objet entity.
     *
     * @Route("/{id}/edit", name="objet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request,Objet $objet)
    {
        $deleteForm = $this->createDeleteForm($objet)
		->add('Valider', SubmitType::class,array('attr' =>array("class"=>"btn btn-info btn-sm")));
        
        $editForm = $this->createForm(objetType::class, $objet)
		->add('Valider', SubmitType::class,array('attr' =>array("class"=>"btn btn-success btn-sm")));
        
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objet_edit', array('id' => $objet->getId()));
        }

        return $this->render('ClientsBundle:objet:edit.html.twig', array(
            'objet' => $objet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a objet entity.
     *
     * @Route("/{id}", name="objet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Objet $objet)
    {
        $form = $this->createDeleteForm($objet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($objet);
            $em->flush($objet);
        }

        return $this->redirectToRoute('objet_index');
    }

    /**
     * Creates a form to delete a objet entity.
     *
     * @param Objet $objet The objet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Objet $objet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('objet_delete', array('id' => $objet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
