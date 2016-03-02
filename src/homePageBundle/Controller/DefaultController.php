<?php

namespace homePageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CmaUserBundle;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	/*if($this->get('security.token_storage')->getToken()->getUser()!='anon.'){
    		if($this->getUser()->hasRole('ROLE_ARTIST')){
    			dump($this->getUser()->getGroupsRoles());
    		}else{
    			dump($this->getUser()->hasGroup(''));
    		}
    	}*/
        $em = $this->getDoctrine()->getManager();
        $pieces = $em->getRepository('CmaUserBundle:Piece')->findBy(array('etat'=>array('5',null)));
        return $this->render('homePageBundle:Default:index.html.twig',array('pieces'=>$pieces));
    }
}
