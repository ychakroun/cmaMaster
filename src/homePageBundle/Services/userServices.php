<?php
namespace homePageBundle\Services;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class userServices {
	
	protected $container;

	public function setContext(TokenStorageInterface $sc)
	{
   		$this->sc = $sc;
	}

    public function allParameter() {
        return $this->sc->getToken()->getUser()->getParameter()->getAll();
    }
}
?>