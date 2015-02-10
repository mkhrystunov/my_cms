<?php

namespace Devy\FrontendBundle\Controller;

use Devy\UkrBookBundle\Entity\ShopInfo;
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
        $products = $em->getRepository('DevyUkrBookBundle:Product');
        $shopInfo = new ShopInfo();
        $shopInfo->load($this->container->getParameter('shopinfo'));

        return $this->render('DevyFrontendBundle::index.html.twig', [
            'posts' => $posts->getActive(),
            'categories' => $categories->getTopLevel(true),
            'products' => $products->getLastAdded(),
            'shopinfo' => $shopInfo,
        ]);
    }
}
