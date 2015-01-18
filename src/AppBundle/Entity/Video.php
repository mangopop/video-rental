<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 */
class Video
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $certificate;

    /**
     * @var string
     */
    private $director;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $videoId;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->videoId = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function __toString()
    {
        return strval($this->id);
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
     * Set title
     *
     * @param string $title
     * @return Video
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set certificate
     *
     * @param string $certificate
     * @return Video
     */
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * Get certificate
     *
     * @return string 
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * Set director
     *
     * @param string $director
     * @return Video
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string 
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Add videoId
     *
     * @param \AppBundle\Entity\UserVideos $videoId
     * @return Video
     */
    public function addVideoId(\AppBundle\Entity\UserVideos $videoId)
    {
        $this->videoId[] = $videoId;

        return $this;
    }

    /**
     * Remove videoId
     *
     * @param \AppBundle\Entity\UserVideos $videoId
     */
    public function removeVideoId(\AppBundle\Entity\UserVideos $videoId)
    {
        $this->videoId->removeElement($videoId);
    }

    /**
     * Get videoId
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVideoId()
    {
        return $this->videoId;
    }
}
