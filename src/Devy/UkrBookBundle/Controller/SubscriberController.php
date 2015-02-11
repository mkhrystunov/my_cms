<?php

namespace Devy\UkrBookBundle\Controller;

use Devy\UkrBookBundle\Entity\Subscriber;
use Devy\UkrBookBundle\Form\SubscriberType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Builder\ValidationBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

/**
 * Class SubscriberController
 * @package Devy\UkrBookBundle\Controller
 */
class SubscriberController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        try {
            $subscriber = new Subscriber();
            $form = $this->createForm(new SubscriberType(), $subscriber);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $subscriber->setIsActive(true);
                $em = $this->getDoctrine()->getManager();
                $em->persist($subscriber);
                $em->flush();

                return new JsonResponse([
                    'success' => true,
                    'message' => 'You successfully subscribed!',
                ]);
            } else {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Please check your email(probably it is already subscribed.',
                ]);
            }
        } catch (\Exception $ex) {
            return new JsonResponse('Error occured. Please Try again later', 500);
        }
    }

    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DevyUkrBookBundle:Subscriber')->getAllSortedByIsActive();

        return $this->render('DevyUkrBookBundle:Subscribers:index.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function activateSubscriberAction($id)
    {
        return $this->toggleStatus($id, true);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function deactivateSubscriberAction($id)
    {
        return $this->toggleStatus($id, false);
    }

    /**
     * @param int $id
     * @param boolean $status
     * @return RedirectResponse
     */
    protected function toggleStatus($id, $status)
    {
        $em = $this->getDoctrine()->getManager();
        $subscriber = $em->getRepository('DevyUkrBookBundle:Subscriber')->find($id);

        if (!$subscriber) {
            throw $this->createNotFoundException('Unable to find Subscriber entity.');
        }

        $subscriber->setIsActive($status);
        $em->persist($subscriber);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Subscriber status updated!');
        return $this->redirect($this->generateUrl('subscribers', ['id' => $subscriber->getId()]));
    }
}
