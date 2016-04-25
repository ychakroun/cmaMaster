<?php
namespace CmaUserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\GroupInterface;
use FOS\UserBundle\Model\GroupableInterface;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\UserRepository")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",name="mango_id",nullable=true)
     */
    protected $mangoId;
    /**
     * @ORM\ManyToMany(targetEntity="CmaUserBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *  joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     * 
     */
    protected $groups;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The firstname is too short.",
     *     maxMessage="The firstname is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Date()
     */
    protected $birthday;

     /** @ORM\Column(type="boolean", name="public_policy") */

    private $publicPolicy;
    /** @ORM\Column(type="boolean", name="is_public",nullable=true) */

    private $isPublic;
    /**
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Parameter", cascade={"persist","remove"})
    */
    private $parameter;
    /**
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Information", cascade={"persist","remove"})
    */
    private $information;
    /**
     * @ORM\ManyToMany(targetEntity="Likes", cascade={"persist","remove"})
     * @ORM\JoinTable(name="likes_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="likes_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $likes;
    /**
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Profile", cascade={"persist","remove"})
    */
    private $profile;

    /**
     * @ORM\ManyToMany(targetEntity="CmaUserBundle\Entity\Estimate", cascade={"persist","remove"})
     * @ORM\JoinTable(name="users_estimates",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="estimate_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $estimates;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        parent::__construct();
    }
    /**
     * Set mangoId
     *
     * @param string $mangoId
     *
     * @return User
     */
    public function setMangoId($mangoId)
    {
        return $this->mangoId = $mangoId;
    }
    /**
     * Get mangoId
     *
     * @param string $mangoId
     *
     * @return User
     */
    public function getMangoId()
    {
        return $this->mangoId;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getFirstName()
    {
        return $this->firstname;
    }
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }
     public function addGroup(GroupInterface $groups)
    {
        parent::addGroup($groups);
        $this->groups[] = $groups;
      
        return $this;
    }
    public function setGroup(ArrayCollection  $groups)
    {
        $this->groups = $groups;

        return $this;
    }
    public function getGroup()
    {
        return $this->groups;
    }
    /**
     * Set publicPolicy
     *
     * @param boolean $publicPolicy
     *
     * @return User
     */
    public function setPublicPolicy($publicPolicy)
    {
        $this->publicPolicy = $publicPolicy;

        return $this;
    }

    /**
     * Get publicPolicy
     *
     * @return boolean
     */
    public function getPublicPolicy()
    {
        return $this->publicPolicy;
    }
    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     *
     * @return User
     */
    public function setIsPublic($boolean)
    {
        $this->isPublic = (Boolean) $boolean;

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
     * Set parameter
     *
     * @param \CmaUserBundle\Entity\Parameter $parameter
     *
     * @return User
     */
    public function setParameter(\CmaUserBundle\Entity\Parameter $parameter= null)
    {
        $this->parameter = $parameter;

        return $this;
    }

    /**
     * Get parameter
     *
     * @return \CmaUserBundle\Entity\Parameter
     */
    public function getParameter()
    {
        return $this->parameter;
    }
    /**
     * Set information
     *
     * @param \CmaUserBundle\Entity\Information $information
     *
     * @return User
     */
    public function setInformation(\CmaUserBundle\Entity\Information $information= null)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return \CmaUserBundle\Entity\Information
     */
    public function getInformation()
    {
        return $this->information;
    }
    /**
     * Set profile
     *
     * @param \CmaUserBundle\Entity\Profile $profile
     *
     * @return User
     */
    public function setProfile(\CmaUserBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \CmaUserBundle\Entity\profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Add estimate
     *
     * @param \CmaUserBundle\Entity\Estimate $estimate
     *
     * @return User
     */
    public function addEstimate(\CmaUserBundle\Entity\Estimate $estimate = null)
    {
        $this->estimates[] = $estimate;

        return $this;
    }

    /**
     * Remove estimate
     *
     * @param \CmaUserBundle\Entity\Estimate $estimate
     */
    public function removeEstimate(\CmaUserBundle\Entity\Estimate $estimate = null)
    {
        $this->estimates->removeElement($estimate);
    }

    /**
     * Get estimates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstimates()
    {
        return $this->estimates;
    }


    /**
     * Add like
     *
     * @param \CmaUserBundle\Entity\Likes $like
     *
     * @return User
     */
    public function addLike(\CmaUserBundle\Entity\Likes $like)
    {
        $this->likes[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \CmaUserBundle\Entity\Likes $like
     */
    public function removeLike(\CmaUserBundle\Entity\Likes $like)
    {
        $this->likes->removeElement($like);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }
}
