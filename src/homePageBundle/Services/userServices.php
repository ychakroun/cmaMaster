<?php
namespace homePageBundle\Services;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class userServices {
	
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