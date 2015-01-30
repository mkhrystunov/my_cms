<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 */
class Order
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $shipping_address;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var integer
     */
    private $amount;

    /**
     * @var \Devy\UkrBookBundle\Entity\User
     */
    private $User;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Products = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set shipping_address
     *
     * @param string $shippingAddress
     * @return Order
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shipping_address = $shippingAddress;

        return $this;
    }

    /**
     * Get shipping_address
     *
     * @return string 
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Order
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Order
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
     * Set User
     *
     * @param \Devy\UkrBookBundle\Entity\User $user
     * @return Order
     */
    public function setUser(\Devy\UkrBookBundle\Entity\User $user = null)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get User
     *
     * @return \Devy\UkrBookBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * Add Products
     *
     * @param \Devy\UkrBookBundle\Entity\Product $products
     * @return Order
     */
    public function addProduct(\Devy\UkrBookBundle\Entity\Product $products)
    {
        $this->Products[] = $products;

        return $this;
    }

    /**
     * Remove Products
     *
     * @param \Devy\UkrBookBundle\Entity\Product $products
     */
    public function removeProduct(\Devy\UkrBookBundle\Entity\Product $products)
    {
        $this->Products->removeElement($products);
    }

    /**
     * Get Products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->Products;
    }
}
