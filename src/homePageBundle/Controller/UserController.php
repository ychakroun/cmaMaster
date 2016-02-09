<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Doctrine\UserManager;
use FOS\UserBundle\Model\UserInterface;

class UserController extends Controller
{
  public function deleteadminAction($username)
  {
    $userManager = $this->get('fos_user.user_manager');
    $repository = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:User');
    $user = $repository->myFindName($username);
    if($user != null){
      $userManager->deleteUser($user[0]);
      return $this->render('homePageBundle:User:delete.html.twig',array('user'=>$user[0]));
    }
    else{
      return $this->render('homePageBundle:User:delete.html.twig',array('user'=>null , 'username'=>$username));
    }
    
  }
}