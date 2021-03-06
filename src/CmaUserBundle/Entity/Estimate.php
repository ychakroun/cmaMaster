<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\DateTimeType;

/**
 * Estimate
 *
 * @ORM\Table(name="estimate")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\EstimateRepository")
 */
class Estimate
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
     * @var bool
     *
     * @ORM\Column(name="orientation", type="boolean",nullable=true)
     */
    private $orientation;

    /**
     * @var string
     *
     * @ORM\Column(name="budget", type="string", length=255, nullable=true)
     */
    private $budget;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
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
     * @ORM\Column(name="technics", type="string", length=255), nullable=true
     */
    private $technics;
        /**
     * @var string
     *
     * @ORM\Column(name="tools", type="string", length=255, nullable=true)
     */
    private $tools;
        /**
     * @var string
     *
     * @ORM\Column(name="width", type="string", length=255, nullable=true)
     */
    private $width;
        /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=255, nullable=true)
     */
    private $height;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_public", type="boolean")
     */
    private $isPublic;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $ownerId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_crush", type="boolean", nullable=true)
     */
    private $isCrush;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_limit", type="datetime", nullable=true)
     */
    private $timeLimit;

    /**
     * @var string
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_adress", type="string", length=255)
     */
    private $deliveryAdress;

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
    *@ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\User")
    */
    private $isValidate;

    /**
     * @ORM\ManyToMany(targetEntity="CmaUserBundle\Entity\Proposal", cascade={"persist","remove"})
     * @ORM\JoinTable(name="estimates_proposals",
     *      joinColumns={@ORM\JoinColumn(name="estimate_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="proposal_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $proposals;



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
     * @return Estimate
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
     * Set timeLimit
     *
     * @param \DateTime $timeLimit
     *
     * @return Estimate
     */
    public function setTimeLimit($timeLimit)
    {
        $this->timeLimit = $timeLimit;

        return $this;
    }

    /**
     * Get timeLimit
     *
     * @return \DateTime
     */
    public function getTimeLimit()
    {
        return $this->timeLimit;
    }

    /**
     * Set deliveryAdress
     *
     * @param string $deliveryAdress
     *
     * @return Estimate
     */
    public function setDeliveryAdress($deliveryAdress)
    {
        $this->deliveryAdress = $deliveryAdress;

        return $this;
    }

    /**
     * Get deliveryAdress
     *
     * @return string
     */
    public function getDeliveryAdress()
    {
        return $this->deliveryAdress;
    }

    public function __construct(){

        $this->setDate(new \DateTime("now"));

    }

    /**
     * Set medium
     *
     * @param string $medium
     *
     * @return Estimate
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
     * Set technics
     *
     * @param string $technics
     *
     * @return Estimate
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
     * @return Estimate
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
     * @param string $width
     *
     * @return Estimate
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param string $height
     *
     * @return Estimate
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     *
     * @return Estimate
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return boolean
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Estimate
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
     * Set image1
     *
     * @param \CmaUserBundle\Entity\Image $image1
     *
     * @return Estimate
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
     * @return Estimate
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
     * @return Estimate
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
     * Set isValidate
     *
     * @param \CmaUserBundle\Entity\User $isValidate
     *
     * @return Estimate
     */
    public function setIsValidate(\CmaUserBundle\Entity\User $isValidate = null)
    {
        $this->isValidate = $isValidate;

        return $this;
    }

    /**
     * Get isValidate
     *
     * @return \CmaUserBundle\Entity\User
     */
    public function getIsValidate()
    {
        return $this->isValidate;
    }

    /**
     * Add proposal
     *
     * @param \CmaUserBundle\Entity\Proposal $proposal
     *
     * @return Estimate
     */
    public function addProposal(\CmaUserBundle\Entity\Proposal $proposal)
    {
        $this->proposals[] = $proposal;

        return $this;
    }

    /**
     * Remove proposal
     *
     * @param \CmaUserBundle\Entity\Proposal $proposal
     */
    public function removeProposal(\CmaUserBundle\Entity\Proposal $proposal)
    {
        $this->proposals->removeElement($proposal);
    }

    /**
     * Get proposals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProposals()
    {
        return $this->proposals;
    }

    /**
     * Set budget
     *
     * @param string $budget
     *
     * @return Estimate
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return string
     */
    public function getBudget()
    {
        return $this->budget;
    }
    public function setDay($day)
    {
        $this->day = $day;
        $timeToLimit = new \DateTime("now");
        $timeToLimit->modify('+'.$day.' days');
        $this->setTimeLimit($timeToLimit);
        return $this;
    }
    public function getDay(){
        return $this->day;
    }

    /**
     * Set orientation
     *
     * @param boolean $orientation
     *
     * @return Estimate
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Get orientation
     *
     * @return boolean
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Estimate
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isCrush
     *
     * @param boolean $isCrush
     *
     * @return Estimate
     */
    public function setIsCrush($isCrush)
    {
        $this->isCrush = $isCrush;

        return $this;
    }

    /**
     * Get isCrush
     *
     * @return boolean
     */
    public function getIsCrush()
    {
        return $this->isCrush;
    }

    /**
     * Set ownerId
     *
     * @param integer $ownerId
     *
     * @return Estimate
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * Get ownerId
     *
     * @return integer
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }
}
