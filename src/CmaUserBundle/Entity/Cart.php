<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table(name="cart")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\CartRepository")
 */
class Cart
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
     * @ORM\ManyToMany(targetEntity="Piece")
     * @ORM\JoinTable(name="cart_pieces",
     *      joinColumns={@ORM\JoinColumn(name="cart_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="piece_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $pieces;
    /**
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user;

    public function __construct()
    {
        $this->pieces = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add piece
     *
     * @param \CmaUserBundle\Entity\Piece $piece
     *
     * @return Cart
     */
    public function addPiece(\CmaUserBundle\Entity\Piece $piece)
    {
        $this->pieces[] = $piece;

        return $this;
    }

    /**
     * Remove piece
     *
     * @param \CmaUserBundle\Entity\Piece $piece
     */
    public function removePiece(\CmaUserBundle\Entity\Piece $piece)
    {
        $this->pieces->removeElement($piece);
    }

    /**
     * Get pieces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPieces()
    {
        return $this->pieces;
    }

    /**
     * Set user
     *
     * @param \CmaUserBundle\Entity\User $user
     *
     * @return Cart
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
}
