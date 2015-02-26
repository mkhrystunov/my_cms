<?php

namespace Devy\UkrBookBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Order
 */
class Order
{
    const STATUS_NEW = 1;
    const STATUS_PENDING = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_UNKNOWN = 1000;
    const STATUS_ABANDONED = 9999;

    /**
     * @return array
     */
    public static function getStatusChoicesArray()
    {
        return [
            self::STATUS_NEW => self::getStringForStatus(self::STATUS_NEW),
            self::STATUS_PENDING => self::getStringForStatus(self::STATUS_PENDING),
            self::STATUS_COMPLETED => self::getStringForStatus(self::STATUS_COMPLETED),
            self::STATUS_UNKNOWN => self::getStringForStatus(self::STATUS_UNKNOWN),
            self::STATUS_ABANDONED => self::getStringForStatus(self::STATUS_ABANDONED),
        ];
    }

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
    private $email;

    /**
     * @var string
     */
    private $shipping_address_city;

    /**
     * @var string
     */
    private $shipping_address_details;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $OrderProduct;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Devy\UkrBookBundle\Entity\User
     */
    private $User;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->OrderProduct = new ArrayCollection();
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
     * @return Order
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
     * @return Order
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
     * Set shipping_address_city
     *
     * @param string $shippingAddressCity
     * @return Order
     */
    public function setShippingAddressCity($shippingAddressCity)
    {
        $this->shipping_address_city = $shippingAddressCity;

        return $this;
    }

    /**
     * Get shipping_address_city
     *
     * @return string 
     */
    public function getShippingAddressCity()
    {
        return $this->shipping_address_city;
    }

    /**
     * Set shipping_address_details
     *
     * @param string $shippingAddressDetails
     * @return Order
     */
    public function setShippingAddressDetails($shippingAddressDetails)
    {
        $this->shipping_address_details = $shippingAddressDetails;

        return $this;
    }

    /**
     * Get shipping_address_details
     *
     * @return string 
     */
    public function getShippingAddressDetails()
    {
        return $this->shipping_address_details;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Order
     * @throws \Exception
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param int $status
     * @return bool
     */
    public static function isAllowedStatus($status)
    {
        $allowedStatuses = [
            self::STATUS_NEW,
            self::STATUS_PENDING,
            self::STATUS_COMPLETED,
            self::STATUS_ABANDONED,
            self::STATUS_UNKNOWN,
        ];
        return in_array($status, $allowedStatuses);
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusString()
    {
        return self::getStringForStatus($this->status);
    }

    /**
     * @param int $status
     * @return string
     */
    public static function getStringForStatus($status)
    {
        switch($status) {
            case self::STATUS_NEW:
                return 'New';
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_COMPLETED:
                return 'Completed';
            case self::STATUS_ABANDONED:
                return 'Abandoned';
            case self::STATUS_UNKNOWN:
            default:
                return 'Unknown';
        }
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Order
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
     * @return Order
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
     * Set User
     *
     * @param \Devy\UkrBookBundle\Entity\User $user
     * @return Order
     */
    public function setUser(\Devy\UkrBookBundle\Entity\User $user = null)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get User
     *
     * @return \Devy\UkrBookBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * Add OrderProduct
     *
     * @param \Devy\UkrBookBundle\Entity\OrderProduct $orderProduct
     * @return Order
     */
    public function addOrderProduct(\Devy\UkrBookBundle\Entity\OrderProduct $orderProduct)
    {
        $this->OrderProduct[] = $orderProduct;
        $orderProduct->setOrder($this);

        return $this;
    }

    /**
     * Remove OrderProduct
     *
     * @param \Devy\UkrBookBundle\Entity\OrderProduct $orderProduct
     */
    public function removeOrderProduct(\Devy\UkrBookBundle\Entity\OrderProduct $orderProduct)
    {
        $this->OrderProduct->removeElement($orderProduct);
    }

    /**
     * Get OrderProduct
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderProduct()
    {
        return $this->OrderProduct;
    }


    /**
     * Set phone
     *
     * @param string $phone
     * @return Order
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
     * @return float
     */
    public function getTotal()
    {
        $total = 0;
        /** @var OrderProduct $orderProduct */
        foreach ($this->getOrderProduct() as $orderProduct) {
            $total += $orderProduct->getProduct()->getPrice() * $orderProduct->getAmount();
        }
        return $total;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $datetime = new DateTime();
        $this->setCreatedAt($datetime);
        $this->setUpdatedAt($datetime);
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new DateTime());
    }

    /**
     * Entity validation function
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank())
            ->addPropertyConstraints('email', [
                new NotBlank(),
                new Email(),
            ])
            ->addPropertyConstraint('phone', new NotBlank())
            ->addConstraint(new Callback('validate'));
    }

    /**
     * @param Order $object
     * @param ExecutionContextInterface $context
     */
    public static function validate(Order $object, ExecutionContextInterface $context)
    {
        if (!self::isAllowedStatus($object->getStatus())) {
            $context->buildViolation('This status "%string%" is not allowed!')
                ->setParameter('%string%', $object->getStatus())
                ->atPath('Status')
                ->addViolation();
        }

        if ($object->getOrderProduct()->isEmpty()) {
            $context->buildViolation('Order should have at least one product')
                ->atPath('OrderProduct')
                ->addViolation();
        }
    }
}
