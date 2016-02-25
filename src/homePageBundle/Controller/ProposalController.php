<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\ProposalType;
use CmaUserBundle\Entity\Proposal;

class ProposalController extends Controller
{
    public function showArtistAction($id,$username)
    {
      $proposal = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Proposal')->findByOneId($id);
      $user = $this->get('security.token_storage')->getToken()->getUser();
      if (!is_object($user)||!$user->hasRole('ROLE_ARTIST'||$user->getUsername()!=$username)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      if(!is_object($proposal)){
        throw new HttpException(404,'This user does not have estimates.');
      }
      $proposal->parent = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId());
      $proposal->owner = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:User')->findOneById($proposal->parent->getOwnerId());
      $proposal->piece = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Piece')->findById($proposal->getPiece()->getId());
      if($proposal->piece->getEtat()==null){
        $proposal->piece->setEtat(1);
      }

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
          dump($proposal);
            $proposal->getPiece()->setTitle($estimate->getTitle());
            $proposal->getPiece()->setIsProposal(true);
            $proposal->getPiece()->setEtat(1);
            $proposal->setUserId($user->getId());
            $proposal->setEstimateId($estimate->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($proposal);
            $estimate->addProposal($proposal);
            $em->persist($estimate);
            dump($estimate);
            $em->flush();
            return $this->redirect($this->generateUrl('artist_proposal'));
        }
      return $this->render('homePageBundle:Proposal:proposal_create.html.twig',array('username'=>$user->getUsername(),'owner'=>$owner,'estimate'=>$estimate,'formProposal' => $formProposal->createView()));
    }
    public function listAction()
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $proposals = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Proposal')->findByUserId($user->getId());
      if (!is_object($user)||!$user->hasRole('ROLE_ARTIST')) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }else if(!count($proposals>0)){
        throw new HttpException(404,'This user does not have estimates.');
      }
      foreach ($proposals as $key => $proposal) {
        $piece = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Piece')->findById($proposal->getPiece()->getId());
        $proposal->parent = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId());
        $proposal->owner = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:User')->findOneById($proposal->parent->getOwnerId())->getUsername();
      }
      dump($proposals);
      return $this->render('homePageBundle:Proposal:proposal_list.html.twig',array('username'=>$user->getUsername(),'proposals' => $proposals));
    }
    public function detailAction(Request $request,$id)
    {
    }
    /*
    public function editAction(Request $request,$id)
    {
    }*/
}