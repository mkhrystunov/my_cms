<?php

namespace Devy\UkrBookBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Devy\UkrBookBundle\Entity\Attribute;
use Devy\UkrBookBundle\Form\AttributeType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Attribute controller.
 *
 */
class AttributeController extends Controller
{

    /**
     * Lists all Attribute entities.
     *
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DevyUkrBookBundle:Attribute')->getAllSortedByIsActive();

        return $this->render('DevyUkrBookBundle:Attribute:index.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * Displays a form to create a new Attribute entity.
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $entity = new Attribute();
        $form = $this->createForm(new AttributeType(), $entity, [
            'action' => $this->generateUrl('attribute_new'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Attribute was created!');
            return $this->redirect($this->generateUrl('attribute'));
        }

        return $this->render('DevyUkrBookBundle:Attribute:new.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing Attribute entity.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevyUkrBookBundle:Attribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attribute entity.');
        }

        $form = $this->createForm(new AttributeType(), $entity, [
            'action' => $this->generateUrl('attribute_edit', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('attribute_edit', ['id' => $entity->getId()]));
        }

        return $this->render('DevyUkrBookBundle:Attribute:edit.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
        ]);
    }
}
