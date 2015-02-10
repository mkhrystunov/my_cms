<?php

namespace Devy\UkrBookBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Devy\UkrBookBundle\Entity\Brand;
use Devy\UkrBookBundle\Form\BrandType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Brand controller.
 *
 */
class BrandController extends Controller
{

    /**
     * Lists all Brand entities.
     *
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DevyUkrBookBundle:Brand')->getAllOrderedByIsActive();

        return $this->render('DevyUkrBookBundle:Brand:index.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * Displays a form to create a new Brand entity.
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $entity = new Brand();
        $form = $this->createForm(new BrandType(), $entity, [
            'action' => $this->generateUrl('brand_new'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Brand was created!');

            return $this->redirect($this->generateUrl('brand'));
        }

        return $this->render('DevyUkrBookBundle:Brand:new.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing Brand entity.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevyUkrBookBundle:Brand')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Brand entity.');
        }

        $form = $this->createForm(new BrandType(), $entity, [
            'action' => $this->generateUrl('brand_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('brand_edit', ['id' => $id]));
        }

        return $this->render('DevyUkrBookBundle:Brand:edit.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }
}
