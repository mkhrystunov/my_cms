<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 */
class Profile
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $sf_guard_profile;

    /**
     * @var \Devy\UkrBookBundle\Entity\User
     */
    private $User;


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
     * Set sf_guard_profile
     *
     * @param string $sfGuardProfile
     * @return Profile
     */
    public function setSfGuardProfile($sfGuardProfile)
    {
        $this->sf_guard_profile = $sfGuardProfile;

        return $this;
    }

    /**
     * Get sf_guard_profile
     *
     * @return string 
     */
    public function getSfGuardProfile()
    {
        return $this->sf_guard_profile;
    }

    /**
     * Set User
     *
     * @param \Devy\UkrBookBundle\Entity\User $user
     * @return Profile
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
}
