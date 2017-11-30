<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Historical;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Historical controller.
 *
 * @Route("historical")
 */
class HistoricalController extends Controller
{
    /**
     * Lists all historical entities.
     *
     * @Route("/", name="historical_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $historicals = $em->getRepository('AppBundle:Historical')->findAll();

        return $this->render('historical/index.html.twig', array(
            'historicals' => $historicals,
        ));
    }

    /**
     * Creates a new historical entity.
     *
     * @Route("/new", name="historical_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $historical = new Historical();
        $form = $this->createForm('AppBundle\Form\HistoricalType', $historical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($historical);
            $em->flush();

            return $this->redirectToRoute('historical_show', array('id' => $historical->getId()));
        }

        return $this->render('historical/new.html.twig', array(
            'historical' => $historical,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a historical entity.
     *
     * @Route("/{id}", name="historical_show")
     * @Method("GET")
     */
    public function showAction(Historical $historical)
    {
        $deleteForm = $this->createDeleteForm($historical);

        return $this->render('historical/show.html.twig', array(
            'historical' => $historical,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing historical entity.
     *
     * @Route("/{id}/edit", name="historical_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Historical $historical)
    {
        $deleteForm = $this->createDeleteForm($historical);
        $editForm = $this->createForm('AppBundle\Form\HistoricalType', $historical);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('historical_edit', array('id' => $historical->getId()));
        }

        return $this->render('historical/edit.html.twig', array(
            'historical' => $historical,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a historical entity.
     *
     * @Route("/{id}", name="historical_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Historical $historical)
    {
        $form = $this->createDeleteForm($historical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($historical);
            $em->flush();
        }

        return $this->redirectToRoute('historical_index');
    }

    /**
     * Creates a form to delete a historical entity.
     *
     * @param Historical $historical The historical entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Historical $historical)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('historical_delete', array('id' => $historical->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
