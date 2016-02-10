<?php
namespace homePageBundle\Services;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
class userServices {
	
	protected $em;

	public function setEntityManager(ObjectManager $em)
	{
   		$this->em = $em;
	}

    public function allParameter() {
        return $this->$em->getUser()->getParameter()
    }
}
?>