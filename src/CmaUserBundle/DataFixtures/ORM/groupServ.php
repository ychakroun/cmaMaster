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
    public function load()
    {
        $artistesGroup = new Group('artist');
        $artistesGroup->addRole('ROLE_ARTIST');
         $this->om->persist($artistesGroup);

        $companysGroup = new Group('company');
        $companysGroup->addRole('ROLE_COMPANY');
         $this->om->persist($companysGroup);

        $privatesGroup = new Group('private');
        $privatesGroup->addRole('ROLE_USER');
         $this->om->persist($privatesGroup);
 
         $this->om->flush();
 
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
    protected $om;

    public function __construct(Doctrine\Common\Persistence\ObjectManager $om)
    {
        $this->om = $om;
    }
}