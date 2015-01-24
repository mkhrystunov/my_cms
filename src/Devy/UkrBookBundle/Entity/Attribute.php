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
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $mode;

    /**
     * @var string
     */
    private $defaults;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var \Devy\UkrBookBundle\Entity\AttributeSet
     */
    private $AttributeSet;

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
     * Set code
     *
     * @param string $code
     * @return Attribute
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set mode
     *
     * @param integer $mode
     * @return Attribute
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Get mode
     *
     * @return integer 
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set defaults
     *
     * @param string $defaults
     * @return Attribute
     */
    public function setDefaults($defaults)
    {
        $this->defaults = $defaults;

        return $this;
    }

    /**
     * Get defaults
     *
     * @return string 
     */
    public function getDefaults()
    {
        return $this->defaults;
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
     * Set AttributeSet
     *
     * @param \Devy\UkrBookBundle\Entity\AttributeSet $attributeSet
     * @return Attribute
     */
    public function setAttributeSet(\Devy\UkrBookBundle\Entity\AttributeSet $attributeSet = null)
    {
        $this->AttributeSet = $attributeSet;

        return $this;
    }

    /**
     * Get AttributeSet
     *
     * @return \Devy\UkrBookBundle\Entity\AttributeSet 
     */
    public function getAttributeSet()
    {
        return $this->AttributeSet;
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
}
