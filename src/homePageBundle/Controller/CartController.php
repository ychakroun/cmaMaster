<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CmaUserBundle\Entity\Cart;

class CartController extends Controller
{
    public function indexAction()
    {
      $em = $this->getDoctrine()->getEntityManager();
    	$user = $this->get('security.token_storage')->getToken()->getUser();
    	$cart = $em->getRepository('CmaUserBundle:Cart')->findOneByUser($user);
    	$pieces = array();
    	if($cart === null){
    		$cart = new Cart();
    		$cart->setUser($user);
    		$em->persist($cart);
    		$em->flush();
    	}else{
    		foreach ($cart->getPieces() as $key => $piece) {
    			if($piece->getUser()){
    				array_push($pieces, $piece);
    			}
    		}
    	}
    	return $this->render('homePageBundle:Cart:index.html.twig',array('pieces'=>$pieces));	
    }
}