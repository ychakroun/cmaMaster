<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Complain
 *
 * @ORM\Table(name="complain")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\ComplainRepository")
 */
class Complain
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="other_user_id", type="integer")
     */
    private $otherUserId;

    /**
     * @var int
     *
     * @ORM\Column(name="phone_number", type="integer")
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_address", type="string", length=255)
     */
    private $mailAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="project_title", type="string", length=255)
     */
    private $projectTitle;

    /**
     * @var text
     *
     * @ORM\Column(name="complain", type="text", nullable=true)
     */
    private $complain;

    /**
    *@ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Image", cascade={"persist","remove"})
    */
    private $image;

    /**
    *@ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Proposal", cascade={"persist","remove"})
    */
    private $proposal;


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
     * Set username
     *
     * @param string $username
     *
     * @return Complain
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
     * Set name
     *
     * @param string $name
     *
     * @return Complain
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set phoneNumber
     *
     * @param int $phoneNumber
     *
     * @return Complain
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return int
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set mailAddress
     *
     * @param string $mailAddress
     *
     * @return Complain
     */
    public function setMailAddress($mailAddress)
    {
        $this->mailAddress = $mailAddress;

        return $this;
    }

    /**
     * Get mailAddress
     *
     * @return string
     */
    public function getMailAddress()
    {
        return $this->mailAddress;
    }

    /**
     * Set projectTitle
     *
     * @param string $projectTitle
     *
     * @return Complain
     */
    public function setProjectTitle($projectTitle)
    {
        $this->projectTitle = $projectTitle;

        return $this;
    }

    /**
     * Get projectTitle
     *
     * @return string
     */
    public function getProjectTitle()
    {
        return $this->projectTitle;
    }

    /**
     * Set complain
     *
     * @param string $complain
     *
     * @return Complain
     */
    public function setComplain($complain)
    {
        $this->complain = $complain;

        return $this;
    }

    /**
     * Get complain
     *
     * @return string
     */
    public function getComplain()
    {
        return $this->complain;
    }

    /**
     * Set image
     *
     * @param \CmaUserBundle\Entity\Image $image
     *
     * @return Complain
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

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Complain
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Complain
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set otherUserId
     *
     * @param integer $otherUserId
     *
     * @return Complain
     */
    public function setOtherUserId($otherUserId)
    {
        $this->otherUserId = $otherUserId;

        return $this;
    }

    /**
     * Get otherUserId
     *
     * @return integer
     */
    public function getOtherUserId()
    {
        return $this->otherUserId;
    }

    /**
     * Set proposal
     *
     * @param \CmaUserBundle\Entity\Proposal $proposal
     *
     * @return Complain
     */
    public function setProposal(\CmaUserBundle\Entity\Proposal $proposal = null)
    {
        $this->Proposal = $proposal;

        return $this;
    }

    /**
     * Get proposal
     *
     * @return \CmaUserBundle\Entity\Proposal
     */
    public function getProposal()
    {
        return $this->Proposal;
    }
}
