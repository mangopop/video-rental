<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserVideos
 */
class UserVideos
{
    /**
     * @var integer
     */
    private $user_id;

    /**
     * @var integer
     */
    private $video_id;

    /**
     * @var \DateTime
     */
    private $out_date;

    /**
     * @var integer
     */
    private $arranged_days_rented;

    /**
     * @var integer
     */
    private $actual_days_rented;

    /**
     * @var \AppBundle\Entity\Video
     */
    private $id;


    /**
     * Set user_id
     *
     * @param integer $userId
     * @return UserVideos
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set video_id
     *
     * @param integer $videoId
     * @return UserVideos
     */
    public function setVideoId($videoId)
    {
        $this->video_id = $videoId;

        return $this;
    }

    /**
     * Get video_id
     *
     * @return integer 
     */
    public function getVideoId()
    {
        return $this->video_id;
    }

    /**
     * Set out_date
     *
     * @param \DateTime $outDate
     * @return UserVideos
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
     * @return UserVideos
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
     * @return UserVideos
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
     * Set id
     *
     * @param \AppBundle\Entity\Video $id
     * @return UserVideos
     */
    public function setId(\AppBundle\Entity\Video $id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \AppBundle\Entity\Video 
     */
    public function getId()
    {
        return $this->id;
    }
}
