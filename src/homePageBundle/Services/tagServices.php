<?php
namespace homePageBundle\Services;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
class tagServices {
	
	protected $em;

	public function setEntityManager(ObjectManager $em)
	{
   		$this->em = $em;
	}
    public function findAll(){
        return $this->em->getRepository("CmaUserBundle:Tag")->findAll();
    }
}
?>