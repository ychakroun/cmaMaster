<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Entity\Cart;

class BuyController extends Controller
{

    public function indexAction($artistUsername,$pieceId)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$artist = $em->getRepository('CmaUserBundle:User')->findOneByUsername($artistUsername);
    	$pieceSelected = $em->getRepository('CmaUserBundle:Piece')->findOneById($pieceId);
    	$initialPieces = $em->getRepository('CmaUserBundle:Piece')->findByUser($artist);
    	$pieces = array();
    	foreach ($initialPieces as $key => $piece) {
    		if($piece->getIsProposal()==null){
    			array_push($pieces, $piece);
    		}
    	}
    	if($pieceSelected === null){
    		throw new HttpException(404,'This piece is not found');
    	}
      	return $this->render('homePageBundle:Buy:index.html.twig',array('artist'=>$artist,'piece'=>$pieceSelected,'pieces'=>$pieces));
    }
    public function addAction(Request $request,$pieceId)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$user = $this->get('security.token_storage')->getToken()->getUser();
    	$cart = $em->getRepository('CmaUserBundle:Cart')->findOneByUser($user);
    	$piece = $em->getRepository('CmaUserBundle:Piece')->findOneById($pieceId);
    	if($cart === null){
    		$cart = new Cart();
    		$cart->setUser($user);
    		$em->persist($cart);
    		$em->flush();
    	}else{
    		$cart->addPiece($piece);
    		$em->persist($cart);
    		$em->flush();
    	}
    	dump($request);
    	$referer = $request->headers->get('referer');
    	return $this->redirect($referer);	
    }
    public function removeAction($pieceId)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$user = $this->get('security.token_storage')->getToken()->getUser();
    	$cart = $em->getRepository('CmaUserBundle:Cart')->findOneByUser($user);
    	$piece = $em->getRepository('CmaUserBundle:Piece')->findOneById($pieceId);
    	$cart->removePiece($piece);
    	$em->persist($cart);
    	$em->flush();
      	return $this->render('homePageBundle:Cart:index.html.twig');
    }
}
