<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
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
     * @var boolean
     */
    private $is_active;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Children;

    /**
     * @var \Devy\UkrBookBundle\Entity\Category
     */
    private $Parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Category
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
     * @return Category
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
     * Set is_active
     *
     * @param boolean $isActive
     * @return Category
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
     * Set image
     *
     * @param string $image
     * @return Category
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
     * Add Children
     *
     * @param \Devy\UkrBookBundle\Entity\Category $children
     * @return Category
     */
    public function addChild(\Devy\UkrBookBundle\Entity\Category $children)
    {
        $this->Children[] = $children;

        return $this;
    }

    /**
     * Remove Children
     *
     * @param \Devy\UkrBookBundle\Entity\Category $children
     */
    public function removeChild(\Devy\UkrBookBundle\Entity\Category $children)
    {
        $this->Children->removeElement($children);
    }

    /**
     * Get Children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->Children;
    }

    /**
     * Set Parent
     *
     * @param \Devy\UkrBookBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\Devy\UkrBookBundle\Entity\Category $parent = null)
    {
        $this->Parent = $parent;

        return $this;
    }

    /**
     * Get Parent
     *
     * @return \Devy\UkrBookBundle\Entity\Category 
     */
    public function getParent()
    {
        return $this->Parent;
    }

    /**
     * Add Products
     *
     * @param \Devy\UkrBookBundle\Entity\Product $products
     * @return Category
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
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;


    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Category
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
     * @return Category
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
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->setUpdatedAt(new \DateTime());
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->getTitle());
    }
}
