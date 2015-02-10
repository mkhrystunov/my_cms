<?php

namespace Devy\UkrBookBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Devy\UkrBookBundle\Entity\Post;
use Devy\UkrBookBundle\Form\PostType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{

    /**
     * Lists all Post entities.
     *
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DevyUkrBookBundle:Post')->getAllSortedByIsActive();

        return $this->render('DevyUkrBookBundle:Post:index.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * Displays a form to create a new Post entity.
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $entity = new Post();
        $form   = $this->createForm(new PostType(), $entity, [
            'action' => $this->generateUrl('post_new'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Post was created!');
            
            return $this->redirect($this->generateUrl('post'));
        }

        return $this->render('DevyUkrBookBundle:Post:new.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing Post entity.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevyUkrBookBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $form = $this->createForm(new PostType(), $entity, [
            'action' => $this->generateUrl('post_edit', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('post_edit', ['id' => $id]));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DevyUkrBookBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Post entity.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DevyUkrBookBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
