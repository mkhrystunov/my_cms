<?php

namespace Devy\FrontendBundle\Controller;

use Devy\FrontendBundle\DependencyInjection\Cart;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CartController
 * @package Devy\FrontendBundle\Controller
 */
class CartController extends Controller
{
    /**
     * @param Request $request
     * @param int $productId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request, $productId)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository('DevyUkrBookBundle:Product')->find($productId);

        if ($product) {
            $session = $request->getSession();
            /** @var Cart $cart */
            $cart = $session->get('cart', new Cart());
            $cart->addProduct($product->getId());
            $session->set('cart', $cart);

            return new JsonResponse([
                'success' => true,
                'message' => sprintf('%s was added', $product->getTitle()),
                'count' => $cart->getCount(),
            ]);
        } else {
            return new JsonResponse([
                'success' => false,
                'message' => 'Some error with product. Please try again.',
            ]);
        }
    }
}
