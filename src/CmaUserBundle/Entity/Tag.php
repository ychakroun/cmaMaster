<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\TagRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Tag
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
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @ORM\ManyToMany(targetEntity="CmaUserBundle\Entity\Profile", mappedBy="tags")
     * 
     */
    private $profiles;

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
     * Set name
     *
     * @param string $name
     *
     * @return Tag
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
     * Set profile
     *
     * @param \CmaUserBundle\Entity\Profile $profile
     *
     * @return Tag
     */
    public function setProfile(\CmaUserBundle\Entity\Profile $profiles = null)
    {
        $this->profiles = $profiles;

        return $this;
    }
    public function addProfile(\CmaUserBundle\Entity\Profile $profile = null)
    {
        $this->profiles[] = $profile;
    }
    /**
     * Get profile
     *
     * @return \CmaUserBundle\Entity\Profile
     */
    public function getProfiles()
    {
        return $this->profiles;
    }
    public function getTag()
    {
        return $this;
    }
    public function __construct()
    {
        $this->profiles = new ArrayCollection();
    }
}
