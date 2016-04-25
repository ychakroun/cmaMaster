<?php
namespace homePageBundle\Services;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManager;


class userServices {
	
    protected $em;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    protected $container;

	public function setContext(TokenStorageInterface $sc)
	{
   		$this->sc = $sc;
	}
	public function getUsername(){
		if(is_string($this->sc->getToken()->getUser())){
    		return null;
    	}
    	else
    	{
    		return $this->sc->getToken()->getUser()->getUsername();
    	}
	}
    public function getId(){
        if(is_string($this->sc->getToken()->getUser())){
            return null;
        }
        else
        {
            return $this->sc->getToken()->getUser()->getId();
        }
    }
    public function allParameter() {
    	if($this->sc->getToken()->getUser()->getParameter()){
    		return $this->sc->getToken()->getUser()->getParameter()->getAll();
    	}
    	else
    	{
    		return null;
    	}
    }
    public function allProfile() {
        if($this->sc->getToken()->getUser()->getProfile()){
            return $this->sc->getToken()->getUser()->getProfile();
        }
        else
        {
            return null;
        }
    }
    public function tagsFromProfile($profile) {
        if($profile->getTags()){
        $tags =  array();
        foreach ($profile->getTags() as $key => $value) {
            array_push($tags, $value);
        }
            return $tags;
        }
        else
        {
            return null;
        }
    }
    public function getCustom($id) {
        $user = $this->em->getRepository('CmaUserBundle:User')->findOneById($id);
        $custom = 0;
        $pieces = $this->em->getRepository('CmaUserBundle:Piece')->findByUser($user);
        foreach ($pieces as $key => $piece) {
            if($piece->getIsProposal()){
                $custom ++;
            }
        }
        return $custom;
    }
    public function doesLikeIt($artistId) {
        $user = $this->sc->getToken()->getUser();
        $artist = $this->em->getRepository('CmaUserBundle:User')->findOneById($artistId);
        if(is_string($user)){
            return false;
        }else{
            $likes = $user->getLikes();
        }
        if($likes!==null){
            foreach ($likes as $key => $like) {
                if($like->getArtist()===$artist){
                    return true;
                }
            }
        }
        return false;
    }
    public function getLikes($id) {
        $artist = $this->em->getRepository('CmaUserBundle:User')->findOneById($id);
        $likes = $this->em->getRepository('CmaUserBundle:Likes')->findByArtist($artist);
        return sizeof($likes);
    }
    public function getOpinion($id) {
        $user = $this->em->getRepository('CmaUserBundle:User')->findOneById($id);
        $crush = 0;
        $opinion = $this->em->getRepository('CmaUserBundle:Opinion')->findByUser($user);
        return count($opinion);
    }
    public function getImageHeader() {
        if($this->sc->getToken()->getUser()->getProfile()){
            $path = $this->sc->getToken()->getUser()->getProfile()->getImageHeader()->getPath();
            return "/images/".$path;
        }
        else
        {
            return null;
        }
    }
}
?>