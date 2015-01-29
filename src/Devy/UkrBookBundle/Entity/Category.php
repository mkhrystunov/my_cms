<?php

namespace Devy\UkrBookBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Category
 */
class Category
{
    /** @var integer */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $description;
    /** @var boolean */
    private $is_active;
    /** @var string */
    private $image;
    /** @var Collection */
    private $Children;
    /** @var Category */
    private $Parent;
    /** @var Collection */
    private $Products;
    /** @var DateTime */
    private $created_at;
    /** @var \DateTime */
    private $updated_at;
    /** @var string */
    private $page_title;
    /** @var string */
    private $meta_description;
    /** @var string */
    private $meta_keywords;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Children = new ArrayCollection();
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
     * @param Category $children
     * @return Category
     */
    public function addChild(Category $children)
    {
        $this->Children[] = $children;

        return $this;
    }

    /**
     * Remove Children
     *
     * @param Category $children
     */
    public function removeChild(Category $children)
    {
        $this->Children->removeElement($children);
    }

    /**
     * Get Children
     *
     * @return Collection
     */
    public function getChildren()
    {
        return $this->Children;
    }

    /**
     * Set Parent
     *
     * @param Category $parent
     * @return Category
     */
    public function setParent(Category $parent = null)
    {
        $this->Parent = $parent;

        return $this;
    }

    /**
     * Get Parent
     *
     * @return Category
     */
    public function getParent()
    {
        return $this->Parent;
    }

    /**
     * Add Products
     *
     * @param Product $products
     * @return Category
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
     * Set created_at
     *
     * @param DateTime $createdAt
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
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param DateTime $updatedAt
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
     * @return DateTime
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
        $this->setCreatedAt(new DateTime());
        $this->setUpdatedAt(new DateTime());
        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->setUpdatedAt(new DateTime());
        return $this;
    }

    /**
     * Set page_title
     *
     * @param string $pageTitle
     * @return Category
     */
    public function setPageTitle($pageTitle)
    {
        $this->page_title = $pageTitle;

        return $this;
    }

    /**
     * Get page_title
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->page_title;
    }

    /**
     * Set meta_description
     *
     * @param string $metaDescription
     * @return Category
     */
    public function setMetaDescription($metaDescription)
    {
        $this->meta_description = $metaDescription;

        return $this;
    }

    /**
     * Get meta_description
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * Set meta_keywords
     *
     * @param string $metaKeywords
     * @return Category
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->meta_keywords = $metaKeywords;

        return $this;
    }

    /**
     * Get meta_keywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * toString method
     *
     * @return string
     */
    public function __toString()
    {
        return strval($this->getTitle());
    }

    /**
     * Returns array of breadcrumbs for BO
     * title => id
     *
     * @return array
     */
    public function createCategoryBreadcrumbs()
    {
        $breadcrumbs = [];
        $category = $this;
        $breadcrumbs[$category->getTitle()] = $category->getId();
        while ($category->getParent()) {
            $category = $category->getParent();
            $breadcrumbs[$category->getTitle()] = $category->getId();
        }
        return array_reverse($breadcrumbs);
    }

    /**
     * Entity validation function
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new NotBlank());
        $metadata->addConstraint(new UniqueEntity(array(
            'fields'  => 'title',
            'message' => 'Use different titles for categories.',
        )));
    }
}
