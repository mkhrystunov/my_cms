<?php

namespace Devy\FrontendBundle\DependencyInjection;

/**
 * Class Cart
 * @package Devy\FrontendBundle\DependencyInjection
 */
class Cart
{
    /**
     * @var int[]
     */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = [];
    }

    /**
     * @param int $productId
     */
    public function addProduct($productId)
    {
        if (isset($this->products[$productId])) {
            $this->products[$productId] += 1;
        } else {
            $this->products[$productId] = 1;
        }
    }

    /**
     * @return int
     */
    public function getCount()
    {
        $count = 0;
        foreach ($this->products as $productQuantity) {
            $count += $productQuantity;
        }
        return $count;
    }

    /**
     * @param int $productId
     * @return int
     */
    public function getProductCount($productId)
    {
        return isset($this->products[$productId]) ? $this->products[$productId] : 0;
    }

    /**
     * @return int[]
     */
    public function getProductIds()
    {
        return array_keys($this->products);
    }
}
