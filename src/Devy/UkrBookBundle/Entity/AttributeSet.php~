<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttributeSet
 */
class AttributeSet
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
    private $Attributes;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     * @return AttributeSet
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
     * @return AttributeSet
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
     * Add Attributes
     *
     * @param \Devy\UkrBookBundle\Entity\Attribute $attributes
     * @return AttributeSet
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
