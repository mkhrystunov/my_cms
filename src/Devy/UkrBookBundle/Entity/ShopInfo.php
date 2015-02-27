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
    private $geo;
    /** @var string */
    private $email;
    /** @var string */
    private $phone;
    /** @var string */
    private $metaDescription;
    /** @var string */
    private $metaKeywords;
    /** @var string */
    private $description;

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
     * @param string $metaDescription
     * @return $this
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaKeywords
     * @return $this
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @return string
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @param string $geo
     * @return $this
     */
    public function setGeo($geo)
    {
        $this->geo = $geo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed|string
     */
    public function getFormattedDescription()
    {
        $description = preg_replace(
            '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@',
            '<a href="$1" target="_blank">$1</a>',
            $this->description
        );
        $description = nl2br($description);
        return $description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
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
            ->setPhone($value['phone'])
            ->setMetaDescription($value['meta_description'])
            ->setMetaKeywords($value['meta_keywords'])
            ->setGeo($value['geo'])
            ->setDescription($value['description']);
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
        $value['meta_description'] = $this->getMetaDescription();
        $value['meta_keywords'] = $this->getMetaKeywords();
        $value['geo'] = $this->getGeo();
        $value['description'] = $this->getDescription();
        $dumper = new Dumper();
        $yaml = $dumper->dump($value, 2);

        file_put_contents($path, $yaml);
    }
}
