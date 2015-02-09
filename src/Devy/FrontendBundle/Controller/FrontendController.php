<?php

namespace Devy\FrontendBundle\Controller;

use Devy\UkrBookBundle\Repository\PostRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontendController extends Controller
{
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var PostRepository $posts */
        $posts = $em->getRepository('DevyUkrBookBundle:Post');
        $categories = $em->getRepository('DevyUkrBookBundle:Category');

        return $this->render('DevyFrontendBundle::index.html.twig', [
            'posts' => $posts->getActive(),
            'categories' => $categories->getTopLevel(true),
        ]);
    }
}
