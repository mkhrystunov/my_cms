<?php

namespace Devy\FrontendBundle\Controller;

use Devy\UkrBookBundle\Entity\ShopInfo;
use Devy\UkrBookBundle\Entity\Subscriber;
use Devy\UkrBookBundle\Form\SubscriberType;
use Devy\UkrBookBundle\Repository\CategoryRepository;
use Devy\UkrBookBundle\Repository\PostRepository;
use Devy\UkrBookBundle\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class FrontendController
 * @package Devy\FrontendBundle\Controller
 */
class FrontendController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('DevyFrontendBundle::index.html.twig', $this->prepareDefault());
    }

    /**
     * @param int $categoryId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction($categoryId)
    {
        $category = $this->getDoctrine()->getRepository('DevyUkrBookBundle:Category')->find($categoryId);

        if (!$category->getIsActive()) {
            throw $this->createNotFoundException('Such category does not exists');
        }

        return $this->render('DevyFrontendBundle::category.html.twig', array_merge($this->prepareDefault(), [
            'category' => $category,
        ]));
    }

    /**
     * @return array
     */
    private function prepareDefault()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var PostRepository $posts */
        $posts = $em->getRepository('DevyUkrBookBundle:Post');
        $categories = $em->getRepository('DevyUkrBookBundle:Category');
        $products = $em->getRepository('DevyUkrBookBundle:Product');
        $shopInfo = new ShopInfo();
        $shopInfo->load($this->container->getParameter('shopinfo'));

        $subscribeForm = $this->createForm(new SubscriberType(), new Subscriber(), [
            'action' => $this->generateUrl('subscriber_new'),
            'method' => 'POST',
        ]);

        return [
            'posts' => $posts->getActive(),
            'categories' => $categories->getTopLevel(true),
            'products' => $products->getLastAdded(),
            'shopinfo' => $shopInfo,
            'subscribe_form' => $subscribeForm->createView(),
        ];
    }
}
