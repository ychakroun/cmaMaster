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
<<<<<<< HEAD
    	$listArtists = $repository->findByRoleAndOffset('ROLE_ARTIST',0);
        return ($listArtists);
=======
    	$listArtists = $repository->findByRoleIndex('ROLE_ARTIST');
				dump(listArtists);
        $artistformat = array();
        foreach ($listArtists as $key => $artist) {
            if($artist->getParameter()!=null&&$artist->getProfile()!=null&&$artist->getIsPublic()){
                array_push($artistformat,$artist);
            }
        }
        return ($artistformat);
>>>>>>> 621918915c39c5953f8a377a8fd538cb4755a403
    }
    public function getNbArtists() {
        $repository = $this->em->getRepository('CmaUserBundle:User');
        $artistReal = 0;
        $listArtists = $repository->findByRole('ROLE_ARTIST');
        foreach ($listArtists as $key => $artist) {
            if($artist->getParameter()!=null&&$artist->getProfile()!=null){
               $artistReal+=1;
            }
        }
        return $artistReal;
    }
    public function allPieces() {
        $repository = $this->em->getRepository('CmaUserBundle:Piece');
        $listPieces = $repository->findAll();
        foreach ($listPieces as $key => $piece) {
            if($piece->getUser()!=null){
               array_push($piecesformat, $piece);
            }
        }
        return $piecesformat;
    }
    public function pageArtist($offset) {
        $offset = $offset-1;
        $repository = $this->em->getRepository('CmaUserBundle:User');
<<<<<<< HEAD
    	$listArtists = $repository->findByRoleAndOffset('ROLE_ARTIST',$offset);
        return ($listArtists);
=======
    	$listArtists = $repository->findByRole('ROLE_ARTIST');
    	$i = 0;
    	$y = 0;
			$artistformat = array();
    	foreach ($listArtists as $key => $artist) {
            if($artist->getParameter()!=null&&$artist->getProfile()!=null&&$artist->getIsPublic()){
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
>>>>>>> 621918915c39c5953f8a377a8fd538cb4755a403
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
            return $information = null;
        }

    }
}
?>
