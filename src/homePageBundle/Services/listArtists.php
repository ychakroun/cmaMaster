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
    	$listArtists = $repository->findByRoleAndOffset('ROLE_ARTIST',0);
        $artists =array();
        $maxIndex = count($listArtists);
        if($maxIndex>4){
            $maxIndex = 4;
        }
        for ($i=0; $i < $maxIndex; $i++) { 
            if($listArtists[$i]){
                array_push($artists, $listArtists[$i]);
            }
        }
        return $artists;
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
    	$listArtists = $repository->findByRoleAndOffset('ROLE_ARTIST',$offset);
        return ($listArtists);
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
