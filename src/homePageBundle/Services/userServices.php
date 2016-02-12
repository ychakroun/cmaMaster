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
            return $this->sc->getToken()->getUser()->getProfile()->getAll();
        }
        else
        {
            return null;
        }
    }
    public function getImageHeader() {
        if($this->sc->getToken()->getUser()->getProfile()){
            return $this->sc->getToken()->getUser()->getProfile()->getImageHeader()->getPath();
        }
        else
        {
            return null;
        }
    }
     public function getTags() {
        if($this->sc->getToken()->getUser()->getProfile()){
            $tab = array();
            foreach ($this->sc->getToken()->getUser()->getProfile()->getTags() as $key => $value) {
                 array_push($tab, $value);
             }
             return $tab;
        }
        else
        {
            return null;
        }
    }
}
?>