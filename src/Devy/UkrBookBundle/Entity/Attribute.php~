<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attribute
 */
class Attribute
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $is_active;

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
     * Set name
     *
     * @param string $name
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return Attribute
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get is_active
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Add Products
     *
     * @param \Devy\UkrBookBundle\Entity\Product $products
     * @return Attribute
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ProductAttributes;


    /**
     * Add ProductAttributes
     *
     * @param \Devy\UkrBookBundle\Entity\ProductAttribute $productAttributes
     * @return Attribute
     */
    public function addProductAttribute(\Devy\UkrBookBundle\Entity\ProductAttribute $productAttributes)
    {
        $productAttributes->setAttribute($this);
        $this->ProductAttributes[] = $productAttributes;

        return $this;
    }

    /**
     * Remove ProductAttributes
     *
     * @param \Devy\UkrBookBundle\Entity\ProductAttribute $productAttributes
     */
    public function removeProductAttribute(\Devy\UkrBookBundle\Entity\ProductAttribute $productAttributes)
    {
        $this->ProductAttributes->removeElement($productAttributes);
    }

    /**
     * Get ProductAttributes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductAttributes()
    {
        return $this->ProductAttributes;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
