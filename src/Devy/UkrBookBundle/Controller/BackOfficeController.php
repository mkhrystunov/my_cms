<?php

namespace Devy\UkrBookBundle\Controller;

use Devy\UkrBookBundle\Utils\NavItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BackOfficeController extends Controller
{
    /**
     * @returns NavItem[]
     */
    protected function buildNavItems()
    {
        // TODO check urls
        $navItems = array();

        $navItems['orders'] = new NavItem('orders', 'Orders', false);
        $navItems['catalog'] = new NavItem($this->generateUrl('admin_categories'), 'Catalog', false);

        return $navItems;
    }
}
