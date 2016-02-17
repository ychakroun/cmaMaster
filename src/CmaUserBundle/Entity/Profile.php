<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\ProfileRepository")
 */
class Profile
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
     * @ORM\Column(name="Description", type="text", nullable=true)
     */
    private $description;

    /**
    *@ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Image", cascade={"persist","remove"})
    */
    private $imageHeader;

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
    * @ORM\ManyToMany(targetEntity="CmaUserBundle\Entity\Tag", inversedBy="profiles",cascade={"persist","remove"})
    * @ORM\JoinColumn(name="profile_tag", referencedColumnName="id")
    *
    */
    private $tags;


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
     * Set description
     *
     * @param string $description
     *
     * @return Profile
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
     * Set imageHeader
     *
     * @param \CmaUserBundle\Entity\Image $imageHeader
     *
     * @return Profile
     */
    public function setImageHeader(\CmaUserBundle\Entity\Image $imageHeader = null)
    {
        $this->imageHeader = $imageHeader;

        return $this;
    }

    /**
     * Get imageHeader
     *
     * @return \CmaUserBundle\Entity\Image
     */
    public function getImageHeader()
    {
        return $this->imageHeader;
    }

    /**
     * Set image1
     *
     * @param \CmaUserBundle\Entity\Image $image1
     *
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getTags()
    {
        return $this->tags;
    }
    public function addTag(\CmaUserBundle\Entity\Tag $tag = null)
    {
        $tag->addProfile($this);
        $this->tags[] = $tag;
        return $this;
    }

    public function removeTag(\CmaUserBundle\Entity\Tag $tag = null)
    {
         $this->tags->removeElement($tag);
    }
    /**
     * Get profile
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfile()
    {
        return $this;
    }
}
