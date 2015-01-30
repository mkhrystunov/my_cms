<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $sf_guard_user;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \Devy\UkrBookBundle\Entity\Profile
     */
    private $Profile;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Orders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Orders = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set sf_guard_user
     *
     * @param string $sfGuardUser
     * @return User
     */
    public function setSfGuardUser($sfGuardUser)
    {
        $this->sf_guard_user = $sfGuardUser;

        return $this;
    }

    /**
     * Get sf_guard_user
     *
     * @return string 
     */
    public function getSfGuardUser()
    {
        return $this->sf_guard_user;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set Profile
     *
     * @param \Devy\UkrBookBundle\Entity\Profile $profile
     * @return User
     */
    public function setProfile(\Devy\UkrBookBundle\Entity\Profile $profile = null)
    {
        $this->Profile = $profile;

        return $this;
    }

    /**
     * Get Profile
     *
     * @return \Devy\UkrBookBundle\Entity\Profile 
     */
    public function getProfile()
    {
        return $this->Profile;
    }

    /**
     * Add Orders
     *
     * @param \Devy\UkrBookBundle\Entity\Order $orders
     * @return User
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
}
