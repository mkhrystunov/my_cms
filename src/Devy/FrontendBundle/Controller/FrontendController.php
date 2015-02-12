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
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FrontendController
 * @package Devy\FrontendBundle\Controller
 */
class FrontendController extends Controller
{
    const DEFAULT_LIMIT = 6;
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $products */
        $products = $manager->getRepository('DevyUkrBookBundle:Product');
        return $this->render('DevyFrontendBundle::index.html.twig', array_merge($this->prepareDefault(), [
            'products' => $products->getLastAdded(),
        ]));
    }

    /**
     * @param Request $request
     * @param int $categoryId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction(Request $request, $categoryId)
    {
        /** @var EntityManager $em */
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $products */
        $products = $manager->getRepository('DevyUkrBookBundle:Product');
        $category = $this->getDoctrine()->getRepository('DevyUkrBookBundle:Category')->find($categoryId);

        $page = $request->query->get('page', 1) ;
        $limit = $request->query->get('limit', self::DEFAULT_LIMIT);
        $sorting = $request->query->get('sort', $products::SORT_NAME_ASC);

        if (!$category->getIsActive()) {
            throw $this->createNotFoundException('Such category does not exists');
        }

        return $this->render('DevyFrontendBundle::category.html.twig', array_merge($this->prepareDefault(), [
            'category' => $category,
            'products' => $products->getByCategoryPaginatedSorted($page, $limit, $category, $sorting),
            'limit' => $limit,
            'page' => $page,
            'sort' => $sorting,
        ]));
    }

    /**
     * @return array
     */
    private function prepareDefault()
    {
        /** @var EntityManager $em */
        $manager = $this->getDoctrine()->getManager();
        /** @var PostRepository $posts */
        $posts = $manager->getRepository('DevyUkrBookBundle:Post');
        /** @var CategoryRepository $categories */
        $categories = $manager->getRepository('DevyUkrBookBundle:Category');
        $shopInfo = new ShopInfo();
        $shopInfo->load($this->container->getParameter('shopinfo'));

        $subscribeForm = $this->createForm(new SubscriberType(), new Subscriber(), [
            'action' => $this->generateUrl('subscriber_new'),
            'method' => 'POST',
        ]);

        return [
            'posts' => $posts->getActive(),
            'categories' => $categories->getTopLevel(true),
            'shopinfo' => $shopInfo,
            'subscribe_form' => $subscribeForm->createView(),
        ];
    }
}
