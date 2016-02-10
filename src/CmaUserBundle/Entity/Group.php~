<?php
namespace CmaUserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\GroupInterface;
use FOS\UserBundle\Model\GroupableInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
     /**
     * @ORM\ManyToMany(targetEntity="CmaUserBundle\Entity\User")
     */
    private $users;

    /**
     * Add user
     *
     * @param \CmaUserBundle\Entity\User $user
     *
     * @return Group
     */
    public function addUser(\CmaUserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \CmaUserBundle\Entity\User $user
     */
    public function removeUser(\CmaUserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
