<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Entity\Opinion;

class OpinionController extends Controller
{

    public function indexAction($username)
    {
    	$user = $this->get('security.token_storage')->getToken()->getUser();
      	$em = $this->getDoctrine()->getManager();
      	$repository = $em->getRepository('CmaUserBundle:Opinion');
      	$artist = $em->getRepository('CmaUserBundle:User')->findOneByUsername($username);
    	$opinions = $repository->findByUser($artist);
      	if (!is_object($user)) {
      	  throw new AccessDeniedException('This user does not have access to this section.');
      	}
    	return $this->render('homePageBundle:Profile:opinions.html.twig',array('artist'=>$artist , 'opinions'=>$opinions));
    }
}
