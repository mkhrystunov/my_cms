<?php

namespace Devy\FrontendBundle\Controller;

use Devy\UkrBookBundle\Entity\ShopInfo;
use Devy\UkrBookBundle\Entity\Subscriber;
use Devy\UkrBookBundle\Form\SubscriberType;
use Devy\UkrBookBundle\Repository\BrandRepository;
use Devy\UkrBookBundle\Repository\CategoryRepository;
use Devy\UkrBookBundle\Repository\PostRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ShopController
 * @package Devy\FrontendBundle\Controller
 */
class ShopController extends Controller
{
    /**
     * @return array
     */
    protected function prepareDefault()
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
