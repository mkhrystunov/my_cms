<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderProduct
 */
class OrderProduct
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $amount;

    /**
     * @var \Devy\UkrBookBundle\Entity\Product
     */
    private $Product;

    /**
     * @var \Devy\UkrBookBundle\Entity\Order
     */
    private $Order;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return OrderProduct
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set Product
     *
     * @param \Devy\UkrBookBundle\Entity\Product $product
     * @return OrderProduct
     */
    public function setProduct(\Devy\UkrBookBundle\Entity\Product $product = null)
    {
        $this->Product = $product;
        $product->addOrderProduct($this);

        return $this;
    }

    /**
     * Get Product
     *
     * @return \Devy\UkrBookBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->Product;
    }

    /**
     * Set Order
     *
     * @param \Devy\UkrBookBundle\Entity\Order $order
     * @return OrderProduct
     */
    public function setOrder(\Devy\UkrBookBundle\Entity\Order $order = null)
    {
        $this->Order = $order;

        return $this;
    }

    /**
     * Get Order
     *
     * @return \Devy\UkrBookBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->Order;
    }
}
