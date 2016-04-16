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
        $pieces = $em->getRepository('CmaUserBundle:Piece')->findBy(array('etat'=>null));
        $piecesWithUserValid = array();
        foreach ($pieces as $key => $piece) {
            $artist = $piece->getUser();
            dump($artist->getIsPublic());
            if($artist->getIsPublic()){
                array_push($piecesWithUserValid,$piece);
            }
        }
        return $this->render('homePageBundle:Default:index.html.twig',array('pieces'=>$piecesWithUserValid));
    }
}
