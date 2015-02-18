<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Review
 */
class Review
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $review;

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
     * Set review
     *
     * @param string $review
     * @return Review
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string 
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set Product
     *
     * @param \Devy\UkrBookBundle\Entity\Product $product
     * @return Review
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
     * @var boolean
     */
    private $is_active;


    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return Review
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
     * @var integer
     */
    private $score;


    /**
     * Set score
     *
     * @param integer $score
     * @return Review
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }
    /**
     * @var \DateTime
     */
    private $posted_at;


    /**
     * Set posted_at
     *
     * @param \DateTime $postedAt
     * @return Review
     */
    public function setPostedAt($postedAt)
    {
        $this->posted_at = $postedAt;

        return $this;
    }

    /**
     * Get posted_at
     *
     * @return \DateTime 
     */
    public function getPostedAt()
    {
        return $this->posted_at;
    }
    /**
     * @ORM\PrePersist
     */
    public function setPostedAtValue()
    {
        $this->posted_at = new \DateTime();
    }
    /**
     * @var string
     */
    private $name;


    /**
     * Set name
     *
     * @param string $name
     * @return Review
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
        return empty($this->name) ? 'Anonymous' : $this->name;
    }

    /**
     * Entity validation function
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('review', [
            new NotBlank(),
            new Length([
                'min' => 15,
                'minMessage' => 'Min character length is 15',
            ]),
        ]);
        $metadata->addPropertyConstraint('score', new Range([
            'min' => 1,
            'max' => 5,
        ]));
    }
}
