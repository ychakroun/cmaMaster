<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\DateTimeType;

/**
 * Piece
 *
 * @ORM\Table(name="piece")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\PieceRepository")
 */
class Piece
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
     * @ORM\Column(name="technics", type="string", length=255, nullable=true)
     */
    private $technics;

    /**
     * @var string
     *
     * @ORM\Column(name="tools", type="string", length=255, nullable=true)
     */
    private $tools;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer", nullable=true)
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="medium", type="string", length=255, nullable=true)
     */
    private $medium;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="text", nullable=true)
     */
    private $theme;
        /**
     * @var string
     *
     * @ORM\Column(name="feature", type="text", nullable=true)
     */
    private $feature;
    /**
     * @var string
     *
     * @ORM\Column(name="collection", type="string", length=255, nullable=true)
     */
    private $collection;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * @var bool
     *
     * @ORM\Column(name="crush", type="boolean", nullable=true)
     */
    private $crush;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_proposal", type="boolean", nullable=true)
     */
    private $isProposal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="realisation_date", type="datetime", nullable=true)
     */
    private $realisationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
    * @ORM\ManyToOne(targetEntity="CmaUserBundle\Entity\User", cascade={"persist","remove"})
    */
    private $user;
    /**
    *@ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Image", cascade={"persist","remove"})
    */
    private $image1;

    /**
    *@ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Image", cascade={"persist","remove"})
    */
    private $image2;

    /**
    *@ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Image", cascade={"persist","remove"})
    */
    private $image3;


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
     * Set technics
     *
     * @param string $technics
     *
     * @return Piece
     */
    public function setTechnics($technics)
    {
        $this->technics = $technics;

        return $this;
    }

    /**
     * Get technics
     *
     * @return string
     */
    public function getTechnics()
    {
        return $this->technics;
    }

    /**
     * Set tools
     *
     * @param string $tools
     *
     * @return Piece
     */
    public function setTools($tools)
    {
        $this->tools = $tools;

        return $this;
    }

    /**
     * Get tools
     *
     * @return string
     */
    public function getTools()
    {
        return $this->tools;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return Piece
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Piece
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return Piece
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Piece
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
     * Set medium
     *
     * @param string $medium
     *
     * @return Piece
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
     * Set theme
     *
     * @param string $theme
     *
     * @return Piece
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set collection
     *
     * @param string $collection
     *
     * @return Piece
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * Get collection
     *
     * @return string
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Piece
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set etat
     *
     * @param int $etat
     *
     * @return Piece
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set crush
     *
     * @param boolean $crush
     *
     * @return Piece
     */
    public function setCrush($crush)
    {
        $this->crush = $crush;

        return $this;
    }

    /**
     * Get crush
     *
     * @return bool
     */
    public function getCrush()
    {
        return $this->crush;
    }

    /**
     * Set realisationDate
     *
     * @param \DateTime $realisationDate
     *
     * @return Piece
     */
    public function setRealisationDate($realisationDate)
    {
        $this->realisationDate = $realisationDate;

        return $this;
    }

    /**
     * Get realisationDate
     *
     * @return \DateTime
     */
    public function getRealisationDate()
    {
        return $this->realisationDate;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Piece
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

    /**
     * Set user
     *
     * @param \CmaUserBundle\Entity\User $user
     *
     * @return Piece
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
    
    public function __construct(){

        $this->setDate(new \DateTime("now"));

    }

    /**
     * Set image1
     *
     * @param \CmaUserBundle\Entity\Image $image1
     *
     * @return Piece
     */
    public function setImage1(\CmaUserBundle\Entity\Image $image1 = null)
    {
        $this->image1 = $image1;

        return $this;
    }

    /**
     * Get image1
     *
     * @return \CmaUserBundle\Entity\Image
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * Set image2
     *
     * @param \CmaUserBundle\Entity\Image $image2
     *
     * @return Piece
     */
    public function setImage2(\CmaUserBundle\Entity\Image $image2 = null)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return \CmaUserBundle\Entity\Image
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * Set image3
     *
     * @param \CmaUserBundle\Entity\Image $image3
     *
     * @return Piece
     */
    public function setImage3(\CmaUserBundle\Entity\Image $image3 = null)
    {
        $this->image3 = $image3;

        return $this;
    }

    /**
     * Get image3
     *
     * @return \CmaUserBundle\Entity\Image
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * Set feature
     *
     * @param string $feature
     *
     * @return Piece
     */
    public function setFeature($feature)
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature
     *
     * @return string
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * Set isProposal
     *
     * @param boolean $isProposal
     *
     * @return Piece
     */
    public function setIsProposal($isProposal)
    {
        $this->isProposal = $isProposal;

        return $this;
    }

    /**
     * Get isProposal
     *
     * @return boolean
     */
    public function getIsProposal()
    {
        return $this->isProposal;
    }
}
