<?php

namespace CmaUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Information
 *
 * @ORM\Table(name="information")
 * @ORM\Entity(repositoryClass="CmaUserBundle\Repository\InformationRepository")
 */
class Information
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
     * @ORM\Column(name="adress", type="text", nullable=true)
     */
    private $adress;

    /**
     * @var int
     *
     * @ORM\Column(name="zip", type="integer", nullable=true)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="text", nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="text", nullable=true)
     */
    private $pays;

    /**
     * @var int
     *
     * @ORM\Column(name="siret", type="bigint", nullable=true)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="ABank", type="text", nullable=true)
     */
    private $aBank;

    /**
     * @var string
     *
     * @ORM\Column(name="ownerBank", type="text", nullable=true)
     */
    private $ownerBank;

    /**
     * @var string
     *
     * @ORM\Column(name="resBank", type="text", nullable=true)
     */
    private $resBank;

    /**
     * @var string
     *
     * @ORM\Column(name="rib", type="text", nullable=true)
     */
    private $rib;

    /**
     * @var string
     *
     * @ORM\Column(name="bic", type="text", nullable=true)
     */
    private $bic;


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
     * Set adress
     *
     * @param string $adress
     *
     * @return Information
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     *
     * @return Information
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return int
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Information
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Information
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set siret
     *
     * @param integer $siret
     *
     * @return Information
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return int
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set aBank
     *
     * @param string $aBank
     *
     * @return Information
     */
    public function setABank($aBank)
    {
        $this->aBank = $aBank;

        return $this;
    }

    /**
     * Get aBank
     *
     * @return string
     */
    public function getABank()
    {
        return $this->aBank;
    }

    /**
     * Set ownerBank
     *
     * @param string $ownerBank
     *
     * @return Information
     */
    public function setOwnerBank($ownerBank)
    {
        $this->ownerBank = $ownerBank;

        return $this;
    }

    /**
     * Get ownerBank
     *
     * @return string
     */
    public function getOwnerBank()
    {
        return $this->ownerBank;
    }

    /**
     * Set resBank
     *
     * @param string $resBank
     *
     * @return Information
     */
    public function setResBank($resBank)
    {
        $this->resBank = $resBank;

        return $this;
    }

    /**
     * Get resBank
     *
     * @return string
     */
    public function getResBank()
    {
        return $this->resBank;
    }

    /**
     * Set rib
     *
     * @param string $rib
     *
     * @return Information
     */
    public function setRib($rib)
    {
        $this->rib = $rib;

        return $this;
    }

    /**
     * Get rib
     *
     * @return string
     */
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * Set bic
     *
     * @param string $bic
     *
     * @return Information
     */
    public function setBic($bic)
    {
        $this->bic = $bic;

        return $this;
    }

    /**
     * Get bic
     *
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }
}

