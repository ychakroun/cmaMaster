<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\UserParameterType;
use CmaUserBundle\Form\UserInformationType;
use CmaUserBundle\Form\ArtistInformationType;
use CmaUserBundle\Entity\User;
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
        if(is_string($this->get('security.token_storage')->getToken()->getUser())) 
        {
          return $this->render('homePageBundle:Default:index.html.twig');
        }else if($this->get('security.token_storage')->getToken()->getUser()->getParameter())
        {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $form = $this->createForm(UserParameterType::class, $user);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute("user_parameter");
            }
            return $this->render('homePageBundle:Parameter:parameter_user.html.twig',array('formPara'=>$form->createView()));
        }else{
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $form = $this->createForm(UserParameterType::class, $user);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute("user_parameter");
            }
            return $this->render('homePageBundle:Parameter:parameter_create.html.twig',array('formPara'=>$form->createView()));
        }
    }
    public function informationAction(Request $request)
    { 
        if(is_string($this->get('security.token_storage')->getToken()->getUser())) 
        {
          return $this->render('homePageBundle:Default:index.html.twig');
        }else{
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if($user->hasRole('ROLE_ARTIST')){
                $form = $this->createForm(ArtistInformationType::class, $user);
            }else{
                $form = $this->createForm(UserInformationType::class, $user);
            }
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute("user_info");
            }

        }
        return $this->render('homePageBundle:User:information_user.html.twig',array('formInfo'=>$form->createView()));
    }
    public function progressAction()
    { 
    $user = $this->get('security.token_storage')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();
    $estimates = $em->getRepository('CmaUserBundle:Estimate')->findByOwnerId($user->getId());
    if (!is_object($user)) {
      throw new AccessDeniedException('This user does not have access to this section.');
    }
    $validEstimates = array();
    foreach ($estimates as $key => $estimate) {
        if(is_object($estimate->getIsValidate())){
            if($user->getId()==$estimate->getOwnerId()){
                $estimate->owner =true;
            }
            array_push($validEstimates, $estimate);
        }
    }
      return $this->render('homePageBundle:Estimate:estimate_progress.html.twig',array('username'=>$user->getUsername(),'estimates' => $validEstimates));
    }
}