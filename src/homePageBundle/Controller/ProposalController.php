<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\ProposalType;
use CmaUserBundle\Form\ProposalEtatType;
use CmaUserBundle\Form\CommentType;
use CmaUserBundle\Entity\Proposal;
use CmaUserBundle\Entity\Comment;

class ProposalController extends Controller
{
    public function showAction(Request $request, $id,$username)
    {
      $em = $this->getDoctrine()->getManager();
      $proposal = $em->getRepository('CmaUserBundle:Proposal')->findOneById($id);
      $proposal->parent = $em->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId());
      $user = $this->get('security.token_storage')->getToken()->getUser();
      if (!is_object($user)||$proposal->getUserId()!=$user->getId()&&$proposal->parent->getOwnerId()!=$user->getId()) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      if(!is_object($proposal)){
        throw new HttpException(404,'This user does not have proposal.');
      }
      if($proposal->getUserId()!=$user->getId()){
        $proposal->otheruser = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->getUserId())->getUsername();
      }else{
        $proposal->otheruser = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->parent->getOwnerId())->getUsername();
      }
      $proposal->owner = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->parent->getOwnerId());
      $comment=new Comment();
      $formComment = $this->createForm(CommentType::class,$comment);
      $proposal->parent = $em->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId());
      $proposal->setPiece = $em->getRepository('CmaUserBundle:Piece')->findById($proposal->getPiece()->getId());
      $formComment->handleRequest($request);
      if($formComment->isValid()){
        $comment->setUserId($user->getId());
        if($comment->getImage()->getPath()==null){
          $comment->setImage(null);
        }
        if($proposal->owner->getId()==$user->getId()){
          $comment->setOwnerComment(true);
        }else{
          $comment->setOwnerComment(false);
        }
        $comment->setUnread(true);
        $em->persist($comment);
        $proposal->addComment($comment);
        $em->persist($proposal);
        $em->flush();
        $comment=new Comment();
        $formComment = $this->createForm(CommentType::class,$comment);
      }
      $formEtat = $this->createForm(ProposalEtatType::class,$proposal);
      $formEtat->handleRequest($request);
      if($formEtat->isValid()){
        $proposal->getPiece()->setEtat($proposal->getPiece()->getEtat()+1);
        $em->persist($proposal);
        $em->flush();
      }
      if($proposal->getPiece()->getEtat()==2&&$user->getId()==$proposal->parent->getOwnerId()){
          return $this->RedirectToRoute('estimate_validation',array('userp'=>$proposal->owner,'id'=>$proposal->parent->getId()));
      }
      $comments = $proposal->getComments();
      foreach ($comments as $i => $comment) {
        if($comment->getUnread()&&$comment->getUserId()!=$user->getId()){
          $comment->setUnread(false);
          $em->persist($comment);
          $em->flush();
        }
        $comment->username = $em->getRepository('CmaUserBundle:User')->findOneById($comment->getUserId())->getUsername();
      }
      return $this->render('homePageBundle:Proposal:proposal_artist_show.html.twig',array('formComment'=>$formComment->createView(),'formEtat'=>$formEtat->createView(),'username'=>$user->getUsername(),'user'=>$user->getId(),'proposal'=>$proposal));
    }
    public function createAction(Request $request,$id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $estimate = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findOneById($id);
      if (!is_object($user)||!$user->hasRole('ROLE_ARTIST')) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      if(!is_object($estimate)){
        throw new HttpException(404,'This user does not have estimates.');
      }
      $owner = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:User')->findOneById($estimate->getOwnerId())->getUsername();
      $proposal = new Proposal();
      $formProposal = $this->createForm(ProposalType::class,$proposal);
      $formProposal->handleRequest($request);
        if ($formProposal->isValid()) {
            $proposal->getPiece()->setTitle($estimate->getTitle());
            $proposal->getPiece()->setIsProposal(true);
            $proposal->getPiece()->setEtat(1);
            $proposal->setUserId($user->getId());
            $proposal->setEstimateId($estimate->getId());
            if($proposal->getPiece()->getImage1()->getPath()==null){
              $proposal->getPiece()->setImage1(null);
            }
            if($proposal->getPiece()->getImage2()->getPath()==null){
              $proposal->getPiece()->setImage2(null);
            }
            if($proposal->getPiece()->getImage3()->getPath()==null){
              $proposal->getPiece()->setImage3(null);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($proposal);
            $estimate->addProposal($proposal);
            $em->persist($estimate);
            $em->flush();
            return $this->redirect($this->generateUrl('artist_proposal'));
        }
      return $this->render('homePageBundle:Proposal:proposal_create.html.twig',array('username'=>$user->getUsername(),'owner'=>$owner,'estimate'=>$estimate,'formProposal' => $formProposal->createView()));
    }
    public function listAction()
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em=$this->getDoctrine()->getManager();
      $proposals = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Proposal')->findByUserId($user->getId());
      foreach ($proposals as $key => $value) {
        # code...
      }
      if (!is_object($user)||!$user->hasRole('ROLE_ARTIST')) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }else if(!count($proposals>0)){
        throw new HttpException(404,'This user does not have estimates.');
      }
      foreach ($proposals as $key => $proposal) {
        $piece = $em->getRepository('CmaUserBundle:Piece')->findById($proposal->getPiece()->getId());
        $proposal->parent = $em->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId());
        $proposal->owner = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->parent->getOwnerId());
        $comments = $proposal->getComments();
        $proposal->unread = 0;
        foreach ($comments as $i => $comment) {
          if($comment->getUnread()&&$comment->getUserId()!=$user->getId()){
            $proposal->unread ++;
          }
        }
      }
      return $this->render('homePageBundle:Proposal:proposal_list.html.twig',array('username'=>$user->getUsername(),'proposals' => $proposals));
    }
    public function deleteAction($id,$idp)
    {
      $em = $this->getDoctrine()->getManager();
      $proposal = $em->getRepository('CmaUserBundle:Proposal')->findOneById($id);
      $estimate = $em->getRepository('CmaUserBundle:Estimate')->findOneById($idp);
      $user = $this->get('security.token_storage')->getToken()->getUser();
      if (!is_object($user)||$proposal->getUserId()!=$user->getId()&&$estimate->getOwnerId()!=$user->getId()) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      if(!is_object($proposal)){
        throw new HttpException(404,'This user does not have proposal.');
      }
      $estimate->removeProposal($proposal);
      $em->persist($estimate);
      $em->flush();
      return $this->RedirectToRoute('user_estimate_proposals',array('id'=>$estimate->getId()));
    }
    /*
    public function editAction(Request $request,$id)
    {
    }*/
}