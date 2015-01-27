<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $description_full;

    /**
     * @var string
     */
    private $code;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var float
     */
    private $price;

    /**
     * @var \Devy\UkrBookBundle\Entity\Brand
     */
    private $Brand;

    /**
     * @var \Devy\UkrBookBundle\Entity\Image
     */
    private $Image;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Reviews;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Orders;

    /**
     * @var \Devy\UkrBookBundle\Entity\Category
     */
    private $Category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Reviews = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Orders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Attributes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description_full
     *
     * @param string $descriptionFull
     * @return Product
     */
    public function setDescriptionFull($descriptionFull)
    {
        $this->description_full = $descriptionFull;

        return $this;
    }

    /**
     * Get description_full
     *
     * @return string
     */
    public function getDescriptionFull()
    {
        return $this->description_full;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Product
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
     * Set is_active
     *
     * @param boolean $isActive
     * @return Product
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Product
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set Brand
     *
     * @param \Devy\UkrBookBundle\Entity\Brand $brand
     * @return Product
     */
    public function setBrand(\Devy\UkrBookBundle\Entity\Brand $brand = null)
    {
        $this->Brand = $brand;

        return $this;
    }

    /**
     * Get Brand
     *
     * @return \Devy\UkrBookBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->Brand;
    }

    /**
     * Set Image
     *
     * @param \Devy\UkrBookBundle\Entity\Image $image
     * @return Product
     */
    public function setImage(\Devy\UkrBookBundle\Entity\Image $image = null)
    {
        $this->Image = $image;

        return $this;
    }

    /**
     * Get Image
     *
     * @return \Devy\UkrBookBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * Add Reviews
     *
     * @param \Devy\UkrBookBundle\Entity\Review $reviews
     * @return Product
     */
    public function addReview(\Devy\UkrBookBundle\Entity\Review $reviews)
    {
        $this->Reviews[] = $reviews;

        return $this;
    }

    /**
     * Remove Reviews
     *
     * @param \Devy\UkrBookBundle\Entity\Review $reviews
     */
    public function removeReview(\Devy\UkrBookBundle\Entity\Review $reviews)
    {
        $this->Reviews->removeElement($reviews);
    }

    /**
     * Get Reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->Reviews;
    }

    /**
     * Add Orders
     *
     * @param \Devy\UkrBookBundle\Entity\Order $orders
     * @return Product
     */
    public function addOrder(\Devy\UkrBookBundle\Entity\Order $orders)
    {
        $this->Orders[] = $orders;

        return $this;
    }

    /**
     * Remove Orders
     *
     * @param \Devy\UkrBookBundle\Entity\Order $orders
     */
    public function removeOrder(\Devy\UkrBookBundle\Entity\Order $orders)
    {
        $this->Orders->removeElement($orders);
    }

    /**
     * Get Orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->Orders;
    }

    /**
     * Set Category
     *
     * @param \Devy\UkrBookBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Devy\UkrBookBundle\Entity\Category $category = null)
    {
        $this->Category = $category;

        return $this;
    }

    /**
     * Get Category
     *
     * @return \Devy\UkrBookBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * Set Orders
     *
     * @param \Devy\UkrBookBundle\Entity\Order $orders
     * @return Product
     */
    public function setOrders(\Devy\UkrBookBundle\Entity\Order $orders = null)
    {
        $this->Orders = $orders;

        return $this;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ProductAttributes;


    /**
     * Add ProductAttributes
     *
     * @param \Devy\UkrBookBundle\Entity\ProductAttribute $productAttributes
     * @return Product
     */
    public function addProductAttribute(\Devy\UkrBookBundle\Entity\ProductAttribute $productAttributes)
    {
        $productAttributes->setProduct($this);
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
     * @param ProductAttribute[] $productAttributes
     */
    public function setProductAttributes(array $productAttributes)
    {
        $this->ProductAttributes = $productAttributes;
    }
}
