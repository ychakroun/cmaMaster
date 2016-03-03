<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\DateTimeType;

/**
 * Opinion
 *
 * @ORM\Table(name="opinion")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\OpinionRepository")
 */
class Opinion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="medium", type="string", length=255)
     */
    private $medium;

    /**
     * @var string
     *
     * @ORM\Column(name="opinion", type="text")
     */
    private $opinion;

    /**
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Image", cascade={"persist","remove"})
    */
    private $image;

    /**
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\User", cascade={"persist","remove"})
    */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Opinion
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
     * Set username
     *
     * @param string $username
     *
     * @return Opinion
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Opinion
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    public function __construct(){

        $this->setDate(new \DateTime("now"));

    }
    /**
     * Set medium
     *
     * @param string $medium
     *
     * @return Opinion
     */
    public function setMedium($medium)
    {
        $this->medium = $medium;

        return $this;
    }

    /**
     * Get medium
     *
     * @return string
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * Set opinion
     *
     * @param string $opinion
     *
     * @return Opinion
     */
    public function setOpinion($opinion)
    {
        $this->opinion = $opinion;

        return $this;
    }

    /**
     * Get opinion
     *
     * @return string
     */
    public function getOpinion()
    {
        return $this->opinion;
    }

    /**
     * Set user
     *
     * @param \CmaUserBundle\Entity\User $user
     *
     * @return Opinion
     */
    public function setUser(\CmaUserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CmaUserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set image
     *
     * @param \CmaUserBundle\Entity\Image $image
     *
     * @return Opinion
     */
    public function setImage(\CmaUserBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \CmaUserBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
