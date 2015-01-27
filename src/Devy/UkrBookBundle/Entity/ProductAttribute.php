<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductAttribute
 */
class ProductAttribute
{
    /**
     * @var integer
     */
    private $product_id;

    /**
     * @var integer
     */
    private $attribute_id;

    /**
     * @var string
     */
    private $value;

    /**
     * @var \Devy\UkrBookBundle\Entity\Product
     */
    private $Product;

    /**
     * @var \Devy\UkrBookBundle\Entity\Attribute
     */
    private $Attribute;


    /**
     * Set product_id
     *
     * @param integer $productId
     * @return ProductAttribute
     */
    public function setProductId($productId)
    {
        $this->product_id = $productId;

        return $this;
    }

    /**
     * Get product_id
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set attribute_id
     *
     * @param integer $attributeId
     * @return ProductAttribute
     */
    public function setAttributeId($attributeId)
    {
        $this->attribute_id = $attributeId;

        return $this;
    }

    /**
     * Get attribute_id
     *
     * @return integer 
     */
    public function getAttributeId()
    {
        return $this->attribute_id;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return ProductAttribute
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set Product
     *
     * @param \Devy\UkrBookBundle\Entity\Product $product
     * @return ProductAttribute
     */
    public function setProduct(\Devy\UkrBookBundle\Entity\Product $product = null)
    {
        $this->Product = $product;

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
     * Set Attribute
     *
     * @param \Devy\UkrBookBundle\Entity\Attribute $attribute
     * @return ProductAttribute
     */
    public function setAttribute(\Devy\UkrBookBundle\Entity\Attribute $attribute = null)
    {
        $this->Attribute = $attribute;

        return $this;
    }

    /**
     * Get Attribute
     *
     * @return \Devy\UkrBookBundle\Entity\Attribute 
     */
    public function getAttribute()
    {
        return $this->Attribute;
    }
}
