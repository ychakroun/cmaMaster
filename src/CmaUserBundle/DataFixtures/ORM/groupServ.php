<?php
namespace Acme\MonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use CmaUserBundle\Entity\Group;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
 
/**
 * Définition de mes groupes
 */
class groupServ extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
   
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager ORM Manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $artistesGroup = new Group('artist');
        $artistesGroup->addRole('ROLE_ARTIST');
        $manager->persist($artistesGroup);

        $companysGroup = new Group('company');
        $companysGroup->addRole('ROLE_COMPANY');
        $manager->persist($companysGroup);

        $privatesGroup = new Group('private');
        $privatesGroup->addRole('ROLE_USER');
        $manager->persist($privatesGroup);
 
        $manager->flush();
 
        $this->addReference('artist-group', $adminsGroup);
        $this->addReference('company-group', $adminsGroup);
        $this->addReference('private-group', $adminsGroup);
    }
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}