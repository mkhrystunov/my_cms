<?php

namespace Devy\FrontendBundle\Controller;

use Devy\UkrBookBundle\Entity\ShopInfo;
use Devy\UkrBookBundle\Entity\Subscriber;
use Devy\UkrBookBundle\Form\SubscriberType;
use Devy\UkrBookBundle\Repository\BrandRepository;
use Devy\UkrBookBundle\Repository\CategoryRepository;
use Devy\UkrBookBundle\Repository\PostRepository;
use Devy\UkrBookBundle\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FrontendController
 * @package Devy\FrontendBundle\Controller
 */
class FrontendController extends Controller
{
    const DEFAULT_LIMIT = 6;
    /**
     * @return Response
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
     * @return Response
     */
    public function categoryAction(Request $request, $categoryId)
    {
        /** @var EntityManager $em */
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $products */
        $products = $manager->getRepository('DevyUkrBookBundle:Product');
        $category = $this->getDoctrine()->getRepository('DevyUkrBookBundle:Category')->find($categoryId);

        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', self::DEFAULT_LIMIT);
        $sorting = $request->query->get('sort', $products::SORT_NAME_ASC);

        if (!$category || !$category->getIsActive()) {
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
     * @param Request $request
     * @param $brandId
     * @return Response
     */
    public function brandAction(Request $request, $brandId)
    {
        /** @var EntityManager $em */
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $products */
        $products = $manager->getRepository('DevyUkrBookBundle:Product');
        $brand = $this->getDoctrine()->getRepository('DevyUkrBookBundle:Brand')->find($brandId);

        $page = $request->query->get('page', 1);

        if (!$brand || !$brand->getIsActive()) {
            throw $this->createNotFoundException('Such brand does not exists');
        }

        return $this->render('DevyFrontendBundle::brand.html.twig', array_merge($this->prepareDefault(), [
            'brand' => $brand,
            'products' => $products->getByBrandPaginated($page, self::DEFAULT_LIMIT, $brand),
            'limit' => self::DEFAULT_LIMIT,
            'page' => $page,
        ]));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchAction(Request $request)
    {
        /** @var EntityManager $em */
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $products */
        $products = $manager->getRepository('DevyUkrBookBundle:Product');

        $page = $request->query->get('page', 1);
        $pattern = $request->request->get('pattern', '');

        return $this->render('DevyFrontendBundle::search.html.twig', array_merge($this->prepareDefault(), [
            'products' => $products->getBySearch(12, $pattern),
            'page' => $page,
            'pattern' => $pattern,
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
        /** @var BrandRepository $brands */
        $brands = $manager->getRepository('DevyUkrBookBundle:Brand');
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
            'brands' => $brands->getAllActive(),
        ];
    }
}
