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
 * @ORM\Entity(repositoryClass="CmaUserBundle\Entity\UserRepository")
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

    /** @ORM\Column(type="boolean", name="newsletter", nullable=true) */

    private $newsletter;

     /** @ORM\Column(type="boolean", name="public_policy") */

    private $publicPolicy;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        parent::__construct();
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
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return User
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter()
    {
        return $this->newsletter;
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
}
