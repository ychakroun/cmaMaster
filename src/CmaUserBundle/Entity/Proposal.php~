<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposal
 *
 * @ORM\Table(name="proposal")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\ProposalRepository")
 */
class Proposal
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="estimate_id", type="integer")
     */
    private $estimateId;

    /**
     * @var int
     *
     * @ORM\Column(name="day", type="integer")
     */
    private $day;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_limit", type="datetime")
     */
    private $timeLimit;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="CmaUserBundle\Entity\Comment", cascade={"persist","remove"})
     * @ORM\JoinTable(name="proposals_comments",
     *      joinColumns={@ORM\JoinColumn(name="proposal_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="comment_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $comments;

    /**
    * @ORM\OneToOne(targetEntity="CmaUserBundle\Entity\Piece", cascade={"persist","remove"})
    */
    private $piece;

    public function __construct(){

        $this->setDate(new \DateTime("now"));

    }

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
     * Set timeLimit
     *
     * @param \DateTime $timeLimit
     *
     * @return Proposal
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
     * Set description
     *
     * @param string $description
     *
     * @return Proposal
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Proposal
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Proposal
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
     * Add comment
     *
     * @param \CmaUserBundle\Entity\Comment $comment
     *
     * @return Proposal
     */
    public function addComment(\CmaUserBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \CmaUserBundle\Entity\Comment $comment
     */
    public function removeComment(\CmaUserBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
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
     * Set piece
     *
     * @param \CmaUserBundle\Entity\Piece $piece
     *
     * @return Proposal
     */
    public function setPiece(\CmaUserBundle\Entity\Piece $piece = null)
    {
        $this->piece = $piece;

        return $this;
    }

    /**
     * Get piece
     *
     * @return \CmaUserBundle\Entity\Piece
     */
    public function getPiece()
    {
        return $this->piece;
    }

    /**
     * Set estimateId
     *
     * @param integer $estimateId
     *
     * @return Proposal
     */
    public function setEstimateId($estimateId)
    {
        $this->estimateId = $estimateId;

        return $this;
    }

    /**
     * Get estimateId
     *
     * @return integer
     */
    public function getEstimateId()
    {
        return $this->estimateId;
    }
}
