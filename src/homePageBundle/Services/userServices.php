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
}
?>