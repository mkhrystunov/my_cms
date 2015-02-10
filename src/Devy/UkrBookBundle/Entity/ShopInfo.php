<?php

namespace Devy\UkrBookBundle\Entity;

use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

/**
 * Class AboutPage
 * @package Devy\UkrBookBundle\Entity
 */
class ShopInfo
{
    /** @var string */
    private $title;
    /** @var string */
    private $address;
    /** @var string */
    private $email;
    /** @var string */
    private $phone;

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
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $path
     */
    public function load($path)
    {
        $yaml = new Parser();
        try {
            $value = $yaml->parse(file_get_contents($path));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
        if (!isset($value)) {
            throw new \UnexpectedValueException();
        }
        $this
            ->setTitle($value['title'])
            ->setAddress($value['address'])
            ->setEmail($value['email'])
            ->setPhone($value['phone']);
    }

    /**
     * @param string $path
     */
    public function save($path)
    {
        $value = [];
        $value['title'] = $this->getTitle();
        $value['address'] = $this->getAddress();
        $value['email'] = $this->getEmail();
        $value['phone'] = $this->getPhone();
        $dumper = new Dumper();
        $yaml = $dumper->dump($value, 2);

        file_put_contents($path, $yaml);
    }
}
