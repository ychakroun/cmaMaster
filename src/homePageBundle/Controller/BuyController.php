<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class BuyController extends Controller
{

    public function indexAction($artistUsername,$pieceId)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$artist = $em->getRepository('CmaUserBundle:User')->findOneByUsername($artistUsername);
    	$piece = $em->getRepository('CmaUserBundle:Piece')->findOneById($pieceId);
    	$initialPieces = $em->getRepository('CmaUserBundle:Piece')->findByUser($artist);
    	$pieces = array();
    	foreach ($initialPieces as $key => $piece) {
    		if($piece->getIsProposal()==null){
    			array_push($pieces, $piece);
    		}
    	}
      	return $this->render('homePageBundle:Buy:index.html.twig',array('artist'=>$artist,'piece'=>$piece,'pieces'=>$pieces));
    }
}
