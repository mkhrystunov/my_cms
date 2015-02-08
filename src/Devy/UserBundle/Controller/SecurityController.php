<?php

namespace Devy\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_form")
     *
     * @param Request $request
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);

        return $this->render('UserBundle::login.html.twig', [
            'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
            'error' => $error,
        ]);
    }

    /**
     * @Route("/login_check", name="login_check")
     *
     * @param Request $request
     */
    public function loginCheckAction(Request $request)
    {

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }
}
