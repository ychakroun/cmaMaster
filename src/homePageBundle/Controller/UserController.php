<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\ParameterType;
use CmaUserBundle\Entity\Parameter;
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
  public function parameterAction(Request $request)
    {
        $para = new Parameter();
        $usrPara = $this->get('home_page.userServices')->allParameter();
        $form = $this->createForm(ParameterType::class, $usrPara);
        $form->handleRequest($request);
        if(is_string($this->get('security.token_storage')->getToken()->getUser())) 
        {
          return $this->render('homePageBundle:Default:index.html.twig');
        }else{
             dump($para);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                //$em->persist($para);
                //$em->flush();
                return $this->redirectToRoute("user_parameter");
            }

        }
        return $this->render('homePageBundle:User:parameter_user.html.twig',array('formPara'=>$form->createView()));
    }
}