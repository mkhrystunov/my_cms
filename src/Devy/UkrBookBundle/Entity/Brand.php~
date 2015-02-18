<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Brand
 */
class Brand
{
    /** @var integer */
    private $id;
    /** @var string */
    private $name;
    /** @var boolean */
    private $is_active;
    /** @var Collection */
    private $Products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Products = new ArrayCollection();
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
     * @return Brand
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
     * @return Brand
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
     * @param Product $products
     * @return Brand
     */
    public function addProduct(Product $products)
    {
        $this->Products[] = $products;

        return $this;
    }

    /**
     * Remove Products
     *
     * @param Product $products
     */
    public function removeProduct(Product $products)
    {
        $this->Products->removeElement($products);
    }

    /**
     * Get Products
     *
     * @return Collection
     */
    public function getProducts()
    {
        return $this->Products;
    }

    /**
     * @return Product[]
     */
    public function getActiveProducts()
    {
        $products = [];
        /** @var Product $product */
        foreach ($this->getProducts() as $product) {
            if ($product->getIsActive()) {
                $products[] = $product;
            }
        }
        return $products;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
