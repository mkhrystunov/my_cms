<?php

namespace Devy\UkrBookBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Devy\UkrBookBundle\Entity\Category;
use Devy\UkrBookBundle\Form\CategoryType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{

    /**
     * Lists all Category entities.
     *
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DevyUkrBookBundle:Category')->getTopLevel(false);

        return $this->render('DevyUkrBookBundle:Category:index.html.twig', array(
            'entities' => $entities,
            'breadcrumbs' => [],
        ));
    }

    /**
     * Creates a new Category entity.
     * @param Request $request
     * @param int|null $parent_id
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request, $parent_id = null)
    {
        $entity = new Category();
        $breadcrumbs = [];
        $em = $this->getDoctrine()->getManager();
        if ($parent_id) {
            $parent = $em->getRepository('DevyUkrBookBundle:Category')->find($parent_id);
            if (!$parent) {
                return $this->createNotFoundException('Unable to find Category entity');
            }
            $entity->setParent($parent);
            $breadcrumbs = $parent->createCategoryBreadcrumbs();
        }

        $form = $this->createForm(new CategoryType(), $entity, [
            'action' => $this->generateUrl('category_new', ['parent_id' => $parent_id]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Category was created!');

            return $this->redirect($this->generateUrl('category_show', array('id' => $entity->getId())));
        }

        return $this->render('DevyUkrBookBundle:Category:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'breadcrumbs' => $breadcrumbs,
            'last_active' => true,
        ));
    }

    /**
     * Finds and displays a Category entity.
     * @param int $id
     * @return Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevyUkrBookBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return $this->render('DevyUkrBookBundle:Category:show.html.twig', array(
            'entity' => $entity,
            'breadcrumbs' => $entity->createCategoryBreadcrumbs(),
        ));
    }

    /**
     * Displays a form to edit an existing Category entity.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevyUkrBookBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }
        $form = $this->createForm(new CategoryType(), $entity, [
            'action' => $this->generateUrl('category_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('category_edit', array('id' => $id)));
        }

        return $this->render('DevyUkrBookBundle:Category:edit.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }
}
