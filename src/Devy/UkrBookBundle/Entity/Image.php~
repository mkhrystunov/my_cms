<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 */
class Image
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \Devy\UkrBookBundle\Entity\Product
     */
    private $Product;


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
     * Set image
     *
     * @param string $image
     * @return Image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set Product
     *
     * @param \Devy\UkrBookBundle\Entity\Product $product
     * @return Image
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
}
