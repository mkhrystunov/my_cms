<?php

namespace Devy\UkrBookBundle\Controller;

use Devy\UkrBookBundle\Entity\Order;
use Devy\UkrBookBundle\Form\OrderTypeAdmin;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OrderController
 * @package Devy\UkrBookBundle\Controller
 */
class OrderController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $entities = $manager->getRepository('DevyUkrBookBundle:Order')->getAll();
        return $this->render('DevyUkrBookBundle:Order:index.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * @param int $orderId
     * @return Response
     */
    public function showAction($orderId)
    {
        $manager = $this->getDoctrine()->getManager();

        $entity = $manager->getRepository('DevyUkrBookBundle:Order')->find($orderId);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        return $this->render('DevyUkrBookBundle:Order:show.html.twig', [
            'entity' => $entity,
        ]);
    }

    /**
     * @param Request $request
     * @param int $orderId
     * @return Response
     */
    public function editAction(Request $request, $orderId)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        /** @var Order $order */
        $entity = $manager->getRepository('DevyUkrBookBundle:Order')->find($orderId);

        if (!$entity) {
            throw $this->createNotFoundException('Order entity wasn\'t found');
        }

        $originalOrderProduct = new ArrayCollection();
        foreach ($entity->getOrderProduct() as $orderProduct) {
            $originalOrderProduct->add($orderProduct);
        }

        $form = $this->createForm(new OrderTypeAdmin(), $entity, [
            'method' => 'put',
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($originalOrderProduct as $orderProduct) {
                if (!$entity->getOrderProduct()->contains($orderProduct)) {
                    $entity->removeOrderProduct($orderProduct);
                    $manager->remove($orderProduct);
                }
            }
            foreach ($entity->getOrderProduct() as $orderProduct) {
                $manager->persist($orderProduct);
            }
            $manager->flush();

            $this->get('session')->getFlashBag()->add('success', 'Order saved!');
            return $this->redirect($this->generateUrl('order_edit', ['orderId' => $entity->getId()]));
        }

        return $this->render('DevyUkrBookBundle:Order:edit.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $entity = new Order();
        $form = $this->createForm(new OrderTypeAdmin(), $entity, [
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($entity->getOrderProduct() as $orderProduct) {
                $manager->persist($orderProduct);
            }
            $manager->persist($entity);
            $manager->flush();

            $this->get('session')->getFlashBag()->add('success', 'Order was created!');
            return $this->redirect($this->generateUrl('order_show', ['orderId' => $entity->getId()]));
        }

        return $this->render('DevyUkrBookBundle:Order:new.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
        ]);
    }
}
