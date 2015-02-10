<?php

namespace Devy\UkrBookBundle\Controller;

use Devy\UkrBookBundle\Entity\ShopInfo;
use Devy\UkrBookBundle\Form\ShopInfoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ShopInfoController
 * @package Devy\UkrBookBundle\Controller
 */
class ShopInfoController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function editAction(Request $request)
    {
        $path = $this->container->getParameter('shopinfo');
        $entity = new ShopInfo();
        $entity->load($path);
        $form = $this->createForm(new ShopInfoType(), $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->save($path);

            $this->get('session')->getFlashBag()->add('success', 'Changes saved!');
        }

        return $this->render('DevyUkrBookBundle:AboutPage:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
