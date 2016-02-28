<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="owner_comment", type="boolean")
     */
    private $ownerComment;

    /**
     * @var boolean
     *
     * @ORM\Column(name="unread", type="boolean",nullable=true)
     */
    private $unread;

    /**
    *@ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Image", cascade={"persist","remove"})
    */
    private $image;


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
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Comment
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Comment
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }
    
    public function __construct(){

        $this->setDate(new \DateTime("now"));

    }

    /**
     * Set ownerComment
     *
     * @param boolean $unread
     *
     * @return Comment
     */
    public function setOwnerComment($ownerComment)
    {
        $this->ownerComment = $ownerComment;

        return $this;
    }

    /**
     * Get ownerComment
     *
     * @return boolean
     */
    public function getOwnerComment()
    {
        return $this->ownerComment;
    }

    /**
     * Set unread
     *
     * @param boolean $unread
     *
     * @return Comment
     */
    public function setUnread($unread)
    {
        $this->unread = $unread;

        return $this;
    }

    /**
     * Get unread
     *
     * @return boolean
     */
    public function getUnread()
    {
        return $this->unread;
    }

    /**
     * Set image
     *
     * @param \CmaUserBundle\Entity\Image $image
     *
     * @return Comment
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
