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
    private $Categories;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Orders;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Attributes;

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
     * Add Categories
     *
     * @param \Devy\UkrBookBundle\Entity\Category $categories
     * @return Product
     */
    public function addCategory(\Devy\UkrBookBundle\Entity\Category $categories)
    {
        $this->Categories[] = $categories;

        return $this;
    }

    /**
     * Remove Categories
     *
     * @param \Devy\UkrBookBundle\Entity\Category $categories
     */
    public function removeCategory(\Devy\UkrBookBundle\Entity\Category $categories)
    {
        $this->Categories->removeElement($categories);
    }

    /**
     * Get Categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->Categories;
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
     * Add Attributes
     *
     * @param \Devy\UkrBookBundle\Entity\Attribute $attributes
     * @return Product
     */
    public function addAttribute(\Devy\UkrBookBundle\Entity\Attribute $attributes)
    {
        $this->Attributes[] = $attributes;

        return $this;
    }

    /**
     * Remove Attributes
     *
     * @param \Devy\UkrBookBundle\Entity\Attribute $attributes
     */
    public function removeAttribute(\Devy\UkrBookBundle\Entity\Attribute $attributes)
    {
        $this->Attributes->removeElement($attributes);
    }

    /**
     * Get Attributes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttributes()
    {
        return $this->Attributes;
    }
}
