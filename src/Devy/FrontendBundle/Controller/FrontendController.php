<?php

namespace Devy\FrontendBundle\Controller;

use Devy\FrontendBundle\DependencyInjection\Cart;
use Devy\UkrBookBundle\Entity\Message;
use Devy\UkrBookBundle\Entity\Order;
use Devy\UkrBookBundle\Entity\OrderProduct;
use Devy\UkrBookBundle\Entity\Product;
use Devy\UkrBookBundle\Entity\Review;
use Devy\UkrBookBundle\Form\MessageType;
use Devy\UkrBookBundle\Form\OrderType;
use Devy\UkrBookBundle\Form\ReviewType;
use Devy\UkrBookBundle\Repository\ProductRepository;
use Devy\UkrBookBundle\Repository\ReviewRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FrontendController
 * @package Devy\FrontendBundle\Controller
 */
class FrontendController extends ShopController
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
        $pattern = $request->query->get('pattern', '');

        return $this->render('DevyFrontendBundle::search.html.twig', array_merge($this->prepareDefault(), [
            'products' => $products->getBySearch(12, $pattern),
            'page' => $page,
            'pattern' => $pattern,
        ]));
    }

    /**
     * @param int $postId
     * @return Response
     */
    public function postAction($postId)
    {
        $post = $this->getDoctrine()->getRepository('DevyUkrBookBundle:Post')->find($postId);
        if (!$post) {
            throw $this->createNotFoundException('Post entity wasn\'t found.');
        }

        return $this->render('DevyFrontendBundle::post.html.twig', array_merge($this->prepareDefault(), [
            'post' => $post,
        ]));
    }

    /**
     * @param Request $request
     * @param int $productId
     * @param Form $reviewForm
     * @return Response
     */
    public function productAction(Request $request, $productId, Form $reviewForm = null)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $products */
        $products = $manager->getRepository('DevyUkrBookBundle:Product');
        /** @var ReviewRepository $reviews */
        $reviews = $manager->getRepository('DevyUkrBookBundle:Review');

        /** @var Product $product */
        $product = $products->find($productId);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $reviewForm = $reviewForm ?: $this->createForm(new ReviewType(), null, [
            'action' => $this->generateUrl('add_review', ['productId' => $product->getId()]),
            'method' => 'post',
        ]);

        return $this->render('DevyFrontendBundle::product.html.twig', array_merge($this->prepareDefault(), [
            'product' => $product,
            'reviews' => $reviews->getActiveByProduct($product, $request->query->get('reviews', self::DEFAULT_LIMIT)),
            'breadcrumbs' => $product->getCategory()->createCategoryBreadcrumbs(),
            'review_form' => $reviewForm->createView(),
        ]));
    }

    /**
     * @param Request $request
     * @param int $productId
     * @return Response
     */
    public function addReviewAction(Request $request, $productId)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $products */
        $products = $manager->getRepository('DevyUkrBookBundle:Product');

        /** @var Product $product */
        $product = $products->find($productId);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $review = new Review();
        $reviewForm = $this->createForm(new ReviewType(), $review);
        $reviewForm->handleRequest($request);

        if ($reviewForm->isValid()) {
            $review->setProduct($product);
            $review->setIsActive(true);
            $manager->persist($review);
            $manager->flush();

            $this->get('session')->getFlashBag()->add('success', 'Review added!');
            return $this->redirectToRoute('front_product', ['productId' => $productId]);
        }

        return $this->productAction($request, $productId, $reviewForm);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function checkoutAction(Request $request)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        /** @var ProductRepository $products */
        $productRepository = $manager->getRepository('DevyUkrBookBundle:Product');
        $session = $request->getSession();
        /** @var Cart $cart */
        $cart = $session->get('cart', new Cart());

        if ($cart->getCount() === 0) {
            $this->get('session')->getFlashBag()->add('warning', 'There is no products in your cart');
            return $this->redirectToRoute('show_cart');
        }

        /** @var Product[] $products */
        $products = $productRepository->findByIds($cart->getProductIds());
        $order = new Order();
        $order->setStatus(Order::STATUS_NEW);
        foreach ($products as $product) {
            $orderProduct = new OrderProduct();
            $orderProduct
                ->setProduct($product)
                ->setAmount($cart->getProductCount($product->getId()));
            $order->addOrderProduct($orderProduct);
        }

        $form = $this->createForm(new OrderType(), $order, [
            'method' => 'post',
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $manager->beginTransaction();
            foreach ($order->getOrderProduct() as $orderProduct) {
                $manager->persist($orderProduct);
            }
            $manager->persist($order);
            $manager->commit();
            $manager->flush();

            $cart->reset();
            $session->set('cart', $cart);

            return $this->redirectToRoute('thank_you');
        }

        return $this->render('DevyFrontendBundle::checkout.html.twig', array_merge($this->prepareDefault(), [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @return Response
     */
    public function thankYouAction()
    {
        return $this->render('DevyFrontendBundle::thank_you.html.twig', $this->prepareDefault());
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function contactAction(Request $request)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $message = new Message();
        $form = $this->createForm(new MessageType(), $message, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->persist($message);
            $manager->flush();

            $this->get('session')->getFlashBag()->add('success', 'Your message was sent!');
            $message = new Message();
            $form = $this->createForm(new MessageType(), $message, [
                'method' => 'POST',
            ]);
        }

        return $this->render('DevyFrontendBundle::contact.html.twig', array_merge($this->prepareDefault(), [
            'form' => $form->createView(),
        ]));
    }

    /**
     * @return Response
     */
    public function aboutAction()
    {
        return $this->render('DevyFrontendBundle::about.html.twig', array_merge($this->prepareDefault(), [

        ]));
    }
}
