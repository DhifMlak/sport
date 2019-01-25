<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Abonnees;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Abonnee controller.
 *
 * @Route("abonnees")
 */
class AbonneesController extends Controller
{
    /**
     * Lists all abonnee entities.
     *
     * @Route("/", name="abonnees_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $abonnees = $em->getRepository('AppBundle:Abonnees')->findAll();

        return $this->render('abonnees/index.html.twig', array(
            'abonnees' => $abonnees,
        ));
    }

    /**
     * Creates a new abonnee entity.
     *
     * @Route("/new", name="abonnees_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $abonnee = new Abonnee();
        $form = $this->createForm('AppBundle\Form\AbonneesType', $abonnee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($abonnee);
            $em->flush();

            return $this->redirectToRoute('abonnees_show', array('id' => $abonnee->getId()));
        }

        return $this->render('abonnees/new.html.twig', array(
            'abonnee' => $abonnee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a abonnee entity.
     *
     * @Route("/{id}", name="abonnees_show")
     * @Method("GET")
     */
    public function showAction(Abonnees $abonnee)
    {
        $deleteForm = $this->createDeleteForm($abonnee);

        return $this->render('abonnees/show.html.twig', array(
            'abonnee' => $abonnee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing abonnee entity.
     *
     * @Route("/{id}/edit", name="abonnees_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Abonnees $abonnee)
    {
        $deleteForm = $this->createDeleteForm($abonnee);
        $editForm = $this->createForm('AppBundle\Form\AbonneesType', $abonnee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abonnees_edit', array('id' => $abonnee->getId()));
        }

        return $this->render('abonnees/edit.html.twig', array(
            'abonnee' => $abonnee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a abonnee entity.
     *
     * @Route("/{id}", name="abonnees_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Abonnees $abonnee)
    {
        $form = $this->createDeleteForm($abonnee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($abonnee);
            $em->flush();
        }

        return $this->redirectToRoute('abonnees_index');
    }

    /**
     * Creates a form to delete a abonnee entity.
     *
     * @param Abonnees $abonnee The abonnee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Abonnees $abonnee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('abonnees_delete', array('id' => $abonnee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
