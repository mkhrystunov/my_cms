<?php

namespace Devy\FrontendBundle\Controller;

use Devy\FrontendBundle\DependencyInjection\Cart;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     */
    public function addAction(Request $request, $productId)
    {
        /** @var EntityManager $manager */
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository('DevyUkrBookBundle:Product')->find($productId);
        $session = $request->getSession();
        /** @var Cart $cart */
        $cart = $session->get('cart', new Cart());

        if ($product) {
            $cart->addProduct($product->getId());
            $this->get('session')->getFlashBag()->add('success', sprintf('%s was added', $product->getTitle()));
        } else {
            $this->get('session')->getFlashBag()->add('notice', sprintf('Some error with product.'));
        }

        $session->set('cart', $cart);
    }
}
