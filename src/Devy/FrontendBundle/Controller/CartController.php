<?php

namespace Devy\FrontendBundle\Controller;

use Devy\FrontendBundle\DependencyInjection\Cart;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CartController
 * @package Devy\FrontendBundle\Controller
 */
class CartController extends ShopController
{
    const DEFAULT_LAST_PRODUCTS_COUNT = 4;

    /**
     * @param Request $request
     * @param int $productId
     * @param int $quantity
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request, $productId, $quantity = 1)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository('DevyUkrBookBundle:Product')->find($productId);

        if ($product) {
            $session = $request->getSession();
            /** @var Cart $cart */
            $cart = $session->get('cart', new Cart());
            $cart->addProduct($product->getId());
            $cart->setProductCount($product->getId(), $quantity);
            $session->set('cart', $cart);

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse([
                    'success' => true,
                    'message' => sprintf('%s was added', $product->getTitle()),
                    'count' => $cart->getCount(),
                ]);
            }
            return $this->redirectToRoute('show_cart');
        } else {
            if ($request->isXmlHttpRequest()) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Some error with product. Please try again.',
                ]);
            }
            throw $this->createNotFoundException('Product not found');
        }
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {
        $session = $request->getSession();
        /** @var Cart $cart */
        $cart = $session->get('cart', new Cart());
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $productsRepo = $manager->getRepository('DevyUkrBookBundle:Product');
        $products = $productsRepo->findByIds($cart->getProductIds());

        $total = 0;
        foreach ($products as $product) {
            $total += $product->getPrice() * $cart->getProductCount($product->getId());
        }

        return $this->render('DevyFrontendBundle::cart.html.twig', array_merge($this->prepareDefault(), [
            'products' => $products,
            'last_products' => $productsRepo->getLastAdded(self::DEFAULT_LAST_PRODUCTS_COUNT),
            'total' => $total,
        ]));
    }

    /**
     * @param Request $request
     * @param int $productId
     * @return JsonResponse
     */
    public function removeAction(Request $request, $productId)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository('DevyUkrBookBundle:Product')->find($productId);
        $session = $request->getSession();
        /** @var Cart $cart */
        $cart = $session->get('cart', new Cart());

        if ($product && $cart->contains($productId)) {
            $cart->removeProduct($product->getId());
            $session->set('cart', $cart);

            return new JsonResponse([
                'success' => true,
                'message' => sprintf('%s was removed', $product->getTitle()),
                'count' => $cart->getCount(),
            ]);
        } else {
            return new JsonResponse([
                'success' => false,
                'message' => 'Some error with product. Please try again.',
            ]);
        }
    }

    /**
     * @param Request $request
     * @param int $productId
     * @param int $quantity
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function setQuantityAction(Request $request, $productId, $quantity)
    {
        $session = $request->getSession();
        /** @var Cart $cart */
        $cart = $session->get('cart', new Cart());
        $cart->setProductCount($productId, intval($quantity));
        return new JsonResponse();
    }
}
