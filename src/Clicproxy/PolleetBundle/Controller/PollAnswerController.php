<?php

namespace Clicproxy\PolleetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Clicproxy\PolleetBundle\Entity\PollAnswer;
use Clicproxy\PolleetBundle\Form\PollAnswerType;

/**
 * PollAnswer controller.
 *
 * @Route("/pollanswer")
 */
class PollAnswerController extends Controller
{

    /**
     * Lists all PollAnswer entities.
     *
     * @Route("/", name="pollanswer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClicproxyPolleetBundle:PollAnswer')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PollAnswer entity.
     *
     * @Route("/", name="pollanswer_create")
     * @Method("POST")
     * @Template("ClicproxyPolleetBundle:PollAnswer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PollAnswer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pollanswer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PollAnswer entity.
     *
     * @param PollAnswer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PollAnswer $entity)
    {
        $form = $this->createForm(new PollAnswerType(), $entity, array(
            'action' => $this->generateUrl('pollanswer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PollAnswer entity.
     *
     * @Route("/new", name="pollanswer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PollAnswer();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PollAnswer entity.
     *
     * @Route("/{id}", name="pollanswer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClicproxyPolleetBundle:PollAnswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PollAnswer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PollAnswer entity.
     *
     * @Route("/{id}/edit", name="pollanswer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClicproxyPolleetBundle:PollAnswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PollAnswer entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a PollAnswer entity.
    *
    * @param PollAnswer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PollAnswer $entity)
    {
        $form = $this->createForm(new PollAnswerType(), $entity, array(
            'action' => $this->generateUrl('pollanswer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PollAnswer entity.
     *
     * @Route("/{id}", name="pollanswer_update")
     * @Method("PUT")
     * @Template("ClicproxyPolleetBundle:PollAnswer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClicproxyPolleetBundle:PollAnswer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PollAnswer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pollanswer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PollAnswer entity.
     *
     * @Route("/{id}", name="pollanswer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClicproxyPolleetBundle:PollAnswer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PollAnswer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pollanswer'));
    }

    /**
     * Creates a form to delete a PollAnswer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pollanswer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
