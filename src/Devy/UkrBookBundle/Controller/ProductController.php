<?php

namespace Devy\UkrBookBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Devy\UkrBookBundle\Entity\Product;
use Devy\UkrBookBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{

    /**
     * Lists all Product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DevyUkrBookBundle:Product')->findAll();

        return $this->render('DevyUkrBookBundle:Product:index.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * Displays a form to create a new Product entity.
     * @param Request $request
     * @param int|null $category_id
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request, $category_id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Product();
        $breadcrumbs = [];
        if ($category_id) {
            $category = $em->getRepository('DevyUkrBookBundle:Category')->find($category_id);
            if (!$category) {
                return $this->createNotFoundException('Unable to find Category entity');
            }
            $entity->setCategory($category);
            $breadcrumbs = $category->createCategoryBreadcrumbs();
        }
        $form = $this->createForm(new ProductType(), $entity, [
            'action' => $this->generateUrl('product_new', ['category_id' => $category_id]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($entity->getProductAttributes() as $productAttribute) {
                $em->persist($productAttribute);
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_show', ['id' => $entity->getId()]));
        }

        return $this->render('DevyUkrBookBundle:Product:new.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
            'breadcrumbs' => $breadcrumbs,
            'last_active' => true,
        ]);
    }

    /**
     * Finds and displays a Product entity.
     * @param int $id
     * @return Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevyUkrBookBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DevyUkrBookBundle:Product:show.html.twig', [
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
            'breadcrumbs' => $entity->getCategory()->createCategoryBreadcrumbs(),
            'last_active' => true,
        ]);
    }

    /**
     * Displays a form to edit an existing Product entity.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevyUkrBookBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $originalProductAttributes = new ArrayCollection();
        foreach ($entity->getProductAttributes() as $productAttribute) {
            $originalProductAttributes->add($productAttribute);
        }

        $form = $this->createForm(new ProductType(), $entity, [
            'action' => $this->generateUrl('product_edit', ['id' => $id]),
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($originalProductAttributes as $productAttribute) {
                if (!$entity->getProductAttributes()->contains($productAttribute)) {
                    $entity->removeProductAttribute($productAttribute);
                    $em->remove($productAttribute);
                }
            }
            foreach ($entity->getProductAttributes() as $productAttribute) {
                $em->persist($productAttribute);
            }
            $em->flush();

            return $this->redirect($this->generateUrl('product_edit', ['id' => $id]));
        }

        return $this->render('DevyUkrBookBundle:Product:edit.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
            'breadcrumbs' => $entity->getCategory()->createCategoryBreadcrumbs(),
            'last_active' => true,
        ]);
    }
}
