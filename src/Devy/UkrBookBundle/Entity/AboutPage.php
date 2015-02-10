<?php

namespace Devy\UkrBookBundle\Entity;

/**
 * Class AboutPage
 * @package Devy\UkrBookBundle\Entity
 */
class AboutPage
{
    /** @var string */
    private $title;
    /** @var string */
    private $address;
    /** @var string */
    private $contacts;

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $contacts
     * @return $this
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
        return $this;
    }

    /**
     * @return string
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
