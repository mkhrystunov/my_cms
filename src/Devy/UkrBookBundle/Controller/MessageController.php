<?php

namespace Devy\UkrBookBundle\Controller;

use Devy\UkrBookBundle\Entity\Message;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MessageController
 * @package Devy\UkrBookBundle\Controller
 */
class MessageController extends Controller
{
    /**
     * Lists all Category entities.
     *
     * @return Response
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('DevyUkrBookBundle:Message')->getAllUnprocessed();

        return $this->render('DevyUkrBookBundle:Message:index.html.twig', [
            'entities' => $entities,
        ]);
    }

    /**
     * @return Response
     */
    public function allAction()
    {
        $entities = $this->getDoctrine()->getRepository('DevyUkrBookBundle:Message')->getAll();
        return $this->render('DevyUkrBookBundle:Message:index.html.twig', [
            'entities' => $entities,
            'show_all' => true,
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function markAsDoneAction($id)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        /** @var Message $message */
        $message = $manager->getRepository('DevyUkrBookBundle:Message')->find($id);

        if (!$message) {
            throw $this->createNotFoundException('There is no message with such id.');
        }

        $message->setProcessed(true);
        $manager->persist($message);
        $manager->flush();

        return $this->redirectToRoute('messages');
    }
}
