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
        return $this->render('homePageBundle:Default:index.html.twig');
    }
}
