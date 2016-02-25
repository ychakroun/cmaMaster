<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\EstimateType;
use CmaUserBundle\Entity\Estimate;

class EstimateController extends Controller
{
    public function showAction()
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      if(!is_object($user)){
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      if($user->getRoles()[0]=='ROLE_ARTIST'){
        $existingEstimates = $em->getRepository('CmaUserBundle:Estimate')->findAll();
        $estimates = array();
        foreach ($existingEstimates as $key => $existingEstimate) {
          if( $user->getId()==$existingEstimate->getOwnerId() && $existingEstimate->getIsPublic() ){
              $existingEstimate->owner = true;
              array_push($estimates, $existingEstimate);
          }else if($existingEstimate->getIsPublic()===true){
            $existingEstimate->owner = false;
            array_push($estimates, $existingEstimate);
          }
        }
      }
      else 
      {
        $Iestimates = $user->getEstimates();
        $estimates =array();
        foreach ($Iestimates as $key => $value) {
          $value->owner = true;
          array_push($estimates, $value);
        }
      }
      return $this->render('homePageBundle:Estimate:estimate_show.html.twig',array('estimates'=>$estimates));
    }
    public function createAction(Request $request)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      if (!is_object($user)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      $estimate = new Estimate();
      $formEstimate = $this->createForm(EstimateType::class,$estimate);
      $formEstimate->handleRequest($request);
        if ($formEstimate->isValid()) {
            if($formEstimate->get('submit')->isClicked()){
              $estimate->setIsPublic(true);
            }else if($formEstimate->get('save')->isClicked()){
              $estimate->setIsPublic(false);
            }
            $estimate->setOwnerId($estimate);
            $em = $this->getDoctrine()->getManager();
            $em->persist($estimate);
            $user->addEstimate($estimate);
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('user_devis'));
        }
      return $this->render('homePageBundle:Estimate:estimate_create.html.twig',array('username'=>$user->getUsername(),'formEstimate' => $formEstimate->createView()));
    }
    public function deleteAction(Request $request,$id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $userEstimates = $user->getEstimates();
      $estimate = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findById($id)[0];
      foreach ($userEstimates as $key => $userEstimate) {
        if($userEstimate->getId()==$estimate->getId()){
          $em = $this->getDoctrine()->getManager();
          $user->removeEstimate($estimate); 
          $em->remove($estimate);
          $em->persist($user);
          $em->flush();
          return $this->redirect($this->generateUrl('user_devis'));
        }
      }
      throw new AccessDeniedException('This user does not have access to this section.');
    }
    public function updateAction(Request $request,$id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $userEstimates = $user->getEstimates();
      $estimate = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findById($id)[0];
      $user->removeEstimate($estimate);
      $formEstimate = $this->createForm(EstimateType::class,$estimate);
      $formEstimate->handleRequest($request);
      if ($formEstimate->isValid()) {
            if($formEstimate->get('submit')->isClicked()){
              $estimate->setIsPublic(true);
            }else if($formEstimate->get('save')->isClicked()){
              $estimate->setIsPublic(false);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($estimate);
            $user->addEstimate($estimate);
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('user_devis'));
        }
      return $this->render('homePageBundle:Estimate:estimate_edit.html.twig',array('username'=>$user->getUsername(),'formEstimate' => $formEstimate->createView()));
    }
    public function editAction(Request $request,$id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $userEstimates = $user->getEstimates();
      $estimate = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findById($id)[0];
      foreach ($userEstimates as $key => $userEstimate) {
        if($userEstimate->getId()==$estimate->getId()){
          $formEstimate = $this->createForm(EstimateType::class,$estimate,array( 'action' => $this->generateUrl('user_estimate_update',array('id'=>$estimate->getId()))));
          if(!$estimate->getIsPublic())
          {
            return $this->redirect($this->generateUrl('user_estimate_update'),array('estimate'=>$estimate->getId()));
          }
          return $this->render('homePageBundle:Estimate:estimate_edit_public.html.twig',array('username'=>$user->getUsername(),'estimate'=>$estimate,'formEstimate' => $formEstimate->createView()));
        }
      }
      if($user->getRoles()[0]=='ROLE_ARTIST'){
        return $this->redirectToRoute('proposal_create',array('id'=>$estimate->getId()));
      }
      throw new AccessDeniedException('This user does not have access to this section.');
    }
    public function detailAction($id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $userEstimates = $user->getEstimates();
      $estimate = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findById($id)[0];
      if(!is_object($estimate)){
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      return $this->render('homePageBundle:Estimate:estimate_detail.html.twig',array('estimate' => $estimate));
    }
    public function proposalListAction($id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $proposals = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findOneById($id)->getProposals();
      if (!is_object($user)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }else if(!count($proposals)>0){
        throw new HttpException(404,'This proposals not found');
      }
      foreach ($proposals as $key => $proposal) {
        $piece = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Piece')->findById($proposal->getPiece()->getId());
        $proposal->parent = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId());
        $proposal->owner = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:User')->findOneById($proposal->parent->getOwnerId())->getUsername();
        $comments = $proposal->getComments();
        $comments = $proposal->getComments();
        $proposal->unread = 0;
        foreach ($comments as $i => $comment) {
          if($comment->getUnread()&&$comment->getUserId()!=$user->getId()){
            $proposal->unread ++;
          }
        }
      }
      return $this->render('homePageBundle:Estimate:estimate_list_proposals.html.twig',array('username'=>$user->getUsername(),'proposals' => $proposals));
    }
}