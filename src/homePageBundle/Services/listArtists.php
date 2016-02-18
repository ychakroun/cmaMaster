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
    public function getNbArtists() {
        $repository = $this->em->getRepository('CmaUserBundle:User');
        $artistReal = 0;
        $listArtists = $repository->findByRoleIndex('ROLE_ARTIST');
        foreach ($listArtists as $key => $artist) {
            if($artist->getParameter()!=null&&$artist->getProfile()!=null){
               $artistReal+=1;
            }
        }
        return $artistReal;
    }
    public function pageArtist() {
        $repository = $this->em->getRepository('CmaUserBundle:User');
    	$listArtists = $repository->findByRole('ROLE_ARTIST');
    	$i = 0;
    	$y = 0;
    	foreach ($listArtists as $key => $artist) {
            if($artist->getParameter()!=null&&$artist->getProfile()!=null){
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
    	}
        return ($artistformat);
    }
    public function getProfile($user) {
        $profile = $this->em
        ->getRepository('CmaUserBundle:Profile')
        ->findOneById($user->getProfile()->getId());
        return $profile;
    }
    public function getInformation($user) {
        if($user->getInformation()){
            $information = $this->em
            ->getRepository('CmaUserBundle:Information')
            ->findOneById($user->getInformation()->getId());
            return $information;
        }else{
            $information = (object) ['city' => 'nc'];
            return $information;
        }
        
    }
}
?>