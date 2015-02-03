<?php

namespace Devy\UkrBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\File as FileConstraint;

/**
 * File
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class File
{
    /** @var integer */
    private $id;
    /** @var string */
    private $path;
    /** @var UploadedFile */
    private $file;
    private $temp;

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
     * Set path
     *
     * @param string $path
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set file
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        if (is_file($this->getAbsolutePath())) {
            // store the old image to delete after update
            $this->temp = $this->getAbsolutePath();
            if ($file) {
                $this->path = $this->file->getPath();
            }
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return null|string
     */
    public function getAbsolutePath()
    {
        return $this->path ? $this->getUploadRootDir() . '/' . $this->path : null;
    }

    /**
     * @return null|string
     */
    public function getWebPath()
    {
        return $this->path ? $this->getUploadDir() . '/' . $this->path : null;
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return 'uploads/files';
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint(
            'file',
            new FileConstraint([
                'maxSize' => 6000000,
            ])
        );
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preUpload()
    {
        if ($this->getFile()) {
            $this->path = $this->file->getClientOriginalName() . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist
     * @ORM\PostUpdate
     */
    public function upload()
    {
        if (!$this->getFile()) {
            return;
        }

        if (isset($this->temp)) {
            var_dump($this->temp);
            // delete old
            unlink($this->temp);
            $this->temp = null;
        }
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->path
        );
        $this->setFile(null);
    }

    /**
     * @ORM\PostRemove
     */
    public function remove()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }
}
