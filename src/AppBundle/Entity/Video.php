<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="videos")
 */
class Video
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $certificate;

    /**
     * @ORM\Column(type="string")
     */
    private $director;

    /**
     * @ORM\OneToMany(targetEntity="Rentals", mappedBy="video")
     */
    private $rentals;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rentals = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add rentals
     *
     * @param \AppBundle\Entity\Rentals $rentals
     * @return User
     */
    public function addRental(\AppBundle\Entity\Rentals $rental)
    {
        $this->rentals[] = $rental;

        return $this;
    }

    /**
     * Remove rentals
     *
     * @param \AppBundle\Entity\Rentals $rentals
     */
    public function removeRentals(\AppBundle\Entity\Rentals $rental)
    {
        $this->rentals->removeElement($rental);
    }

    /**
     * Get rentals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRentals()
    {
        return $this->rentals;
    }
}
