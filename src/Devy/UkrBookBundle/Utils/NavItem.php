<?php

namespace Devy\UkrBookBundle\Utils;

class NavItem
{
    /** @var string */
    private $link;
    /** @var string */
    private $text;
    /** @var bool */
    private $isActive;

    /**
     * @param string $link
     * @param string $text
     * @param bool $isActive
     */
    public function __construct($link = null, $text = null, $isActive = null)
    {
        if (isset($link)) {
            $this->setLink($link);
        }
        if (isset($text)) {
            $this->setText($text);
        }
        if (isset($isActive)) {
            $this->setIsActive($isActive);
        }
    }

    /**
     * @param string $link
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
