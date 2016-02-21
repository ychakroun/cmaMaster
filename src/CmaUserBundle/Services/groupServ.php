<?php

namespace CmaUserBundle\Services;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use CmaUserBundle\Entity\Group;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
 
/**
 * Définition de mes groupes
 */
class groupServ 
{
   
    public function load()
    {
 

        $artistesGroup = new Group('artist');
        $artistesGroup->addRole('ROLE_ARTIST');
         $this->em->persist($artistesGroup);

        $companysGroup = new Group('company');
        $companysGroup->addRole('ROLE_COMPANY');
         $this->em->persist($companysGroup);

        $privatesGroup = new Group('private');
        $privatesGroup->addRole('ROLE_USER');
         $this->em->persist($privatesGroup);
 
         $this->em->flush();
 
    }
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
    protected $om;

    public function omloader(EntityManager $em)
    {
        $this->em = $em;
    }
}