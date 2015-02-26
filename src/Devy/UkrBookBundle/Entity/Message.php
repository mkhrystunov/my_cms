<?php

namespace Devy\UkrBookBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Message
 */
class Message
{
    /** @var integer */
    private $id;
    /** @var string */
    private $subject;
    /** @var string */
    private $message;
    /** @var string */
    private $name;
    /** @var string */
    private $email;
    /** @var string */
    private $phone;
    /** @var \DateTime */
    private $posted_at;
    /** @var boolean */
    private $processed;

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
     * Set subject
     *
     * @param string $subject
     * @return Message
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Message
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
     * Set email
     *
     * @param string $email
     * @return Message
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Message
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set posted_at
     *
     * @param \DateTime $postedAt
     * @return Message
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
     * Set processed
     *
     * @param boolean $processed
     * @return Message
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;

        return $this;
    }

    /**
     * Get processed
     *
     * @return boolean 
     */
    public function isProcessed()
    {
        return $this->processed;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setPostedAt(new DateTime);
        $this->setProcessed(false);
    }

    /**
     * Entity validation function
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('email', [
            new NotBlank(),
            new Email(),
        ])
            ->addPropertyConstraint('subject', new NotBlank())
            ->addPropertyConstraints('message', [
                new NotBlank(),
                new Length([
                    'min' => 15,
                    'minMessage' => 'Min character length is 15',
                ]),
            ]);
    }
}
