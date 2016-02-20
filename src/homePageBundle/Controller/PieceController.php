<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\HttpNotFoundException;
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
      	throw new HttpNotFoundException('This user does not have pieces.');
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
      if(!is_object($piece)){
      	throw new HttpNotFoundException('This Piece does not exist.');
      }
      $form = $this->createForm(PieceType::class, $piece);
        $form->handleRequest($request);
        $piece->setUser($user);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($piece);
            $em->flush();
            return $this->redirectToRoute("artist_profile");
        }
        return $this->render("homePageBundle:Piece:piece_edit.html.twig",array('formPiece' => $form->createView()));
    }
    public function createAction(Request $request)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $piece = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findById($user);
      $nbPiece = sizeof($piece);
      if (!is_object($user)) {
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
            		return $this->render("homePageBundle:Piece:piece_create.html.twig",array('formPiece' => $form->createView(),'nbPiece' => $nbPiece,'noSiret'=>true));
            	}
        	}else{
            	return $this->render("homePageBundle:Piece:piece_create.html.twig",array('formPiece' => $form->createView(),'nbPiece' => $nbPiece,'noSiret'=>true));
            }
        }
        return $this->render("homePageBundle:Piece:piece_create.html.twig",array('formPiece' => $form->createView(),'nbPiece' => $nbPiece,'noSiret'=>false));
    }
}