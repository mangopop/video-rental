<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Rentals
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $out_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $arranged_days_rented;

    /**
     * @ORM\Column(type="integer")
     */
    private $actual_days_rented;

    /**
     * @ORM\Column(type="integer")
     */
    private $archived;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="rentals")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=FALSE, onDelete="cascade")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Video", inversedBy="rentals")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id", nullable=FALSE, onDelete="cascade")
     */
    protected $video;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set User
     * @param User $user
     * @return $this
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set Video
     * @param Video $video
     * @return $this
     */
    public function setVideo(Video $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return integer 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set out_date
     *
     * @param \DateTime $outDate
     * @return Rentals
     */
    public function setOutDate($outDate)
    {
        $this->out_date = $outDate;

        return $this;
    }

    /**
     * Get out_date
     *
     * @return \DateTime 
     */
    public function getOutDate()
    {
        return $this->out_date;
    }

    /**
     * Set arranged_days_rented
     *
     * @param integer $arrangedDaysRented
     * @return Rentals
     */
    public function setArrangedDaysRented($arrangedDaysRented)
    {
        $this->arranged_days_rented = $arrangedDaysRented;

        return $this;
    }

    /**
     * Get arranged_days_rented
     *
     * @return integer 
     */
    public function getArrangedDaysRented()
    {
        return $this->arranged_days_rented;
    }

    /**
     * Set actual_days_rented
     *
     * @param integer $actualDaysRented
     * @return Rentals
     */
    public function setActualDaysRented($actualDaysRented)
    {
        $this->actual_days_rented = $actualDaysRented;

        return $this;
    }

    /**
     * Get actual_days_rented
     *
     * @return integer 
     */
    public function getActualDaysRented()
    {
        return $this->actual_days_rented;
    }

    /**
     * @param mixed $archived
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }

    /**
     * @return mixed
     */
    public function getArchived()
    {
        return $this->archived;
    }



}
