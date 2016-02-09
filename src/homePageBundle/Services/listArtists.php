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
    	$i = 0;
    	$y = 0;
    	foreach ($listArtists as $key => $artist) {
    		$tab = 'tab'.$key;
    		if($i == 6){
    			$i = 0;
    			$y++;
    			$artistformat[$y][$i] = $artist; 
    		}else{
    			$artistformat[$y][$i] = $artist;
    		}
    		$i++;
    	}
        return ($artistformat);
    }
}
?>