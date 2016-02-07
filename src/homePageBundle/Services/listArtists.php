<?php
namespace homePageBundle\Services;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
class listArtists {
	
	protected $em;

	public function setEntityManager(ObjectManager $em)
	{
   		$this->em = $em;
	}

     public function indexAction() {
        $repository = $this->em->getRepository('CmaUserBundle:User');
    	$listArtists = $repository->findByRoleIndex('ROLE_ARTIST');
        return ($listArtists);
    }
    public function pageArtist() {
        $repository = $this->em->getRepository('CmaUserBundle:User');
    	$listArtists = $repository->findByRole('ROLE_ARTIST');
        return ($listArtists);
    }
}
?>