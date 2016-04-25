<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\LikesRepository")
 */
class Likes
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
     * @ORM\ManyToOne(targetEntity="CmaUserBundle\Entity\User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="CmaUserBundle\Entity\User")
     */
    private $artist;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \CmaUserBundle\Entity\User $user
     *
     * @return Likes
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
     * Set artist
     *
     * @param \CmaUserBundle\Entity\User $artist
     *
     * @return Likes
     */
    public function setArtist(\CmaUserBundle\Entity\User $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \CmaUserBundle\Entity\User
     */
    public function getArtist()
    {
        return $this->artist;
    }
}
