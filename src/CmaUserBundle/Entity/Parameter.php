<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parameter
 *
 * @ORM\Table(name="parameter")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\ParameterRepository")
 */
class Parameter
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
     * @ORM\Column(name="mailDevisAll", type="boolean", nullable=true)
     */
    private $mailDevisAll;

    /**
     * @var bool
     *
     * @ORM\Column(name="mailDevisUser", type="boolean", nullable=true)
     */
    private $mailDevisUser;

    /**
     * @var bool
     *
     * @ORM\Column(name="mailDevisCom", type="boolean", nullable=true)
     */
    private $mailDevisCom;

    /**
     * @var bool
     *
     * @ORM\Column(name="mailDevisValid", type="boolean", nullable=true)
     */
    private $mailDevisValid;

    /**
     * @var bool
     *
     * @ORM\Column(name="isPublic", type="boolean", nullable=true)
     */
    private $isPublic;

    /**
     * @var bool
     *
     * @ORM\Column(name="newsletter", type="boolean", nullable=true)
     */
    private $newsletter;


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
     * Set mailDevisAll
     *
     * @param boolean $mailDevisAll
     *
     * @return Parameter
     */
    public function setMailDevisAll($mailDevisAll)
    {
        $this->mailDevisAll = $mailDevisAll;

        return $this;
    }

    /**
     * Get mailDevisAll
     *
     * @return bool
     */
    public function getMailDevisAll()
    {
        return $this->mailDevisAll;
    }

    /**
     * Set mailDevisUser
     *
     * @param boolean $mailDevisUser
     *
     * @return Parameter
     */
    public function setMailDevisUser($mailDevisUser)
    {
        $this->mailDevisUser = $mailDevisUser;

        return $this;
    }

    /**
     * Get mailDevisUser
     *
     * @return bool
     */
    public function getMailDevisUser()
    {
        return $this->mailDevisUser;
    }

    /**
     * Set mailDevisCom
     *
     * @param boolean $mailDevisCom
     *
     * @return Parameter
     */
    public function setMailDevisCom($mailDevisCom)
    {
        $this->mailDevisCom = $mailDevisCom;

        return $this;
    }

    /**
     * Get mailDevisCom
     *
     * @return bool
     */
    public function getMailDevisCom()
    {
        return $this->mailDevisCom;
    }

    /**
     * Set mailDevisValid
     *
     * @param boolean $mailDevisValid
     *
     * @return Parameter
     */
    public function setMailDevisValid($mailDevisValid)
    {
        $this->mailDevisValid = $mailDevisValid;

        return $this;
    }

    /**
     * Get mailDevisValid
     *
     * @return bool
     */
    public function getMailDevisValid()
    {
        return $this->mailDevisValid;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     *
     * @return Parameter
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return bool
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return Parameter
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return bool
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    public function getAll()
    {
        return $this;
    }
}
