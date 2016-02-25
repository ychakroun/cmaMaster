<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CmaUserBundle\Entity\Piece;
use CmaUserBundle\Form\PieceType;

class PieceController extends Controller
{
    public function viewAction()
    {
      $em = $this->getDoctrine()->getManager();
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $pieces = $em->getRepository('CmaUserBundle:Piece')->findBy($user);
      if(sizeof($pieces)){
      	throw new HttpException(404,'This user does not have pieces.');
      }
      return $this->render('homePageBundle:Gallerie:index.html.twig',array('pieces' => $pieces));
    }
    public function editAction(Request $request,$id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      if (!is_object($user)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      $piece = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findById($id);
      dump($piece[0]);
      if(!is_object($piece[0])){
      	throw new HttpException(404,'This Piece does not exist.');
      }
      if($piece[0]->getUser()->getId()!=$user->getId()){
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      $form = $this->createForm(PieceType::class, $piece[0]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($piece[0]);
            $em->flush();
            return $this->redirectToRoute("artist_profile",array('username'=>$user->getUsername()));
        }
        return $this->render("homePageBundle:Piece:piece_edit.html.twig",array('formPiece' => $form->createView(),'username' => $user->getUsername(),'piece'=>$piece[0],'noSiret'=>false));
    }
    public function createAction(Request $request)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $pieces = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findByUser($user);
      $nbPiece = sizeof($pieces);
      if (!is_object($user)||$user->getRoles()[0]!='ROLE_ARTIST') {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      $piece = new Piece();
      $form = $this->createForm(PieceType::class, $piece);
        $form->handleRequest($request);
        $piece->setUser($user);
        if ($form->isValid()) {
        	if($user->getInformation()){
        		if($user->getInformation()->getSiret()&&$user->getInformation()->getRib()){
        		$em = $this->getDoctrine()->getManager();
            	$em->persist($piece);
            	$em->flush();
            	return $this->redirectToRoute("artist_profile",array('username'=>$user->getUsername()));
            	}else{
            		return $this->render("homePageBundle:Piece:piece_create.html.twig",array('formPiece' => $form->createView(),'username' => $user->getUsername(),'nbPiece' => $nbPiece,'noSiret'=>true));
            	}
        	}else{
            	return $this->render("homePageBundle:Piece:piece_create.html.twig",array('formPiece' => $form->createView(),'username' => $user->getUsername(),'nbPiece' => $nbPiece,'noSiret'=>true));
            }
        }
        return $this->render("homePageBundle:Piece:piece_create.html.twig",array('formPiece' => $form->createView(),'username' => $user->getUsername(),'nbPiece' => $nbPiece,'noSiret'=>false));
    }
}