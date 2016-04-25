<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\EstimateType;
use CmaUserBundle\Form\OpinionType;
use CmaUserBundle\Entity\Estimate;
use CmaUserBundle\Entity\Opinion;

class EstimateController extends Controller
{
    public function opinionAction(Request $request,$id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      if (!is_object($user)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      $proposal = $em->getRepository('CmaUserBundle:Proposal')->findOneById($id);
      $proposal->owner = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->getUserId())->getUsername();
      $opinion = new Opinion();
      $opinion->setUser($em->getRepository('CmaUserBundle:User')->findOneById($proposal->getUserId()));
      $opinion->setMedium($em->getRepository('CmaUserBundle:Piece')->findOneById($proposal->getPiece()->getId())->getMedium());
      $opinion->setUsername($user->getUsername());
      $formOpinion = $this->createForm(OpinionType::class,$opinion);
      $formOpinion->handleRequest($request);
      if($formOpinion->isValid()){
        if(is_null($opinion->getMedium())){
          $opinion->setMedium('piece.default.medium');
        }
        if(is_null($opinion->getImage()->getPath())){
          $opinion->setImage(null);
        }
        $em->persist($opinion);
        $em->flush();
        return $this->redirect($this->generateUrl('user_finish_project'));
      }else{
        dump($formOpinion);
      }
      return $this->render('homePageBundle:Estimate:estimate_opinion.html.twig',array('formOpinion'=>$formOpinion->createView(),'user'=>$user,'proposal'=>$proposal));
    }
    public function showAction()
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      if(!is_object($user)){
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      if($user->hasRole('ROLE_ARTIST')){
        $existingEstimates = $em->getRepository('CmaUserBundle:Estimate')->findAll();
        $estimates = array();
        foreach ($existingEstimates as $key => $existingEstimate) {
          if( $user->getId()==$existingEstimate->getOwnerId() && $existingEstimate->getIsPublic() && is_null($existingEstimate->getIsValidate())){
            $existingEstimate->owner = true;
            array_push($estimates, $existingEstimate);
          }else if($existingEstimate->getIsPublic() && is_null($existingEstimate->getIsValidate())){
            $existingEstimate->owner = false;
            array_push($estimates, $existingEstimate);
          }else if($user->getId()==$existingEstimate->getOwnerId()&&is_null($existingEstimate->getIsValidate())){
            $existingEstimate->owner = true;
            array_push($estimates, $existingEstimate);
          }
        }
      }
      else 
      {
        $Iestimates = $user->getEstimates();
        $estimates =array();
        foreach ($Iestimates as $key => $estimate) {
          if(is_null($estimate->getIsValidate())){
            $estimate->owner = true;
            array_push($estimates, $estimate);
          }
        }
      }
      return $this->render('homePageBundle:Estimate:estimate_show.html.twig',array('estimates'=>$estimates));
    }
    public function createAction(Request $request)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      if (!is_object($user)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      $estimate = new Estimate();
      $formEstimate = $this->createForm(EstimateType::class,$estimate);
      $formEstimate->handleRequest($request);
        if ($formEstimate->isValid()) {
            if($estimate->getImage1()->getPath()==null){
              $estimate->setImage1(null);
            }
            if($estimate->getImage2()->getPath()==null){
              $estimate->setImage2(null);
            }
            if($estimate->getImage3()->getPath()==null){
              $estimate->setImage3(null);
            }
            if($formEstimate->get('submit')->isClicked()){
              $estimate->setIsPublic(true);
            }else if($formEstimate->get('save')->isClicked()){
              $estimate->setIsPublic(false);
            }
            $estimate->setOwnerId($user->getId());
            $user->addEstimate($estimate);
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('user_devis'));
        }
      return $this->render('homePageBundle:Estimate:estimate_create.html.twig',array('username'=>$user->getUsername(),'formEstimate' => $formEstimate->createView()));
    }
    public function createUniqueAction(Request $request,$artistId)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      $artist = $em->getRepository('CmaUserBundle:User')->findOneById($artistId);
      if (!is_object($user)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      $estimate = new Estimate();
      $formEstimate = $this->createForm(EstimateType::class,$estimate);
      $formEstimate->handleRequest($request);
        if ($formEstimate->isValid()) {
            if($estimate->getImage1()->getPath()==null){
              $estimate->setImage1(null);
            }
            if($estimate->getImage2()->getPath()==null){
              $estimate->setImage2(null);
            }
            if($estimate->getImage3()->getPath()==null){
              $estimate->setImage3(null);
            }
            if($formEstimate->get('submit')->isClicked()){
              $estimate->setIsPublic(true);
            }else if($formEstimate->get('save')->isClicked()){
              $estimate->setIsPublic(false);
            }
            $estimate->setOwnerId($user->getId());
            $estimate->setIsValidate($artist);
            $user->addEstimate($estimate);
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('progress_project'));
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
          $em->persist($user);
          $em->remove($estimate);
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
      $estimate = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findOneById($id);
      $user->removeEstimate($estimate);
      $formEstimate = $this->createForm(EstimateType::class,$estimate);
      $formEstimate->handleRequest($request);
      if ($formEstimate->isValid()) {
            if($formEstimate->get('submit')->isClicked()){
              $estimate->setIsPublic(true);
            }else if($formEstimate->get('save')->isClicked()){
              $estimate->setIsPublic(false);
            }
            if($estimate->getImage1()->getPath()==null){
              $estimate->setImage1(null);
            }
            if($estimate->getImage2()->getPath()==null){
              $estimate->setImage2(null);
            }
            if($estimate->getImage3()->getPath()==null){
              $estimate->setImage3(null);
            }
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
      return $this->render('homePageBundle:Estimate:estimate_edit.html.twig',array('username'=>$user->getUsername(),'formEstimate' => $formEstimate->createView(),'estimate'=>$estimate));
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
            return $this->redirectToRoute('user_estimate_update',array('id'=>$estimate->getId()));
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
      $estimate = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:Estimate')->findOneById($id);
      $usernameOfestimate = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:User')->findOneById($estimate->getOwnerId());
      if(!is_object($estimate)){
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      return $this->render('homePageBundle:Estimate:estimate_detail.html.twig',array('estimate' => $estimate,'usernameOfestimate'=>$usernameOfestimate));
    }
    public function proposalListAction($id)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      $proposals = $em->getRepository('CmaUserBundle:Estimate')->findOneById($id)->getProposals();
      if (!is_object($user)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }else if(!count($proposals)>0){
        throw new HttpException(404,'This proposals not found');
      }
      foreach ($proposals as $key => $proposal) {
        $piece = $em->getRepository('CmaUserBundle:Piece')->findById($proposal->getPiece()->getId());
        $proposal->parent = $em->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId());
        if($user->getId()==$proposal->parent->getOwnerId()){
          $proposal->otheruser = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->getUserId())->getUsername();
        }else{
          $proposal->otheruser = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->parent->getOwnerId())->getUsername();
        }
        $proposal->owner = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->parent->getOwnerId())->getUsername();
        $comments = $proposal->getComments();
        $comments = $proposal->getComments();
        $proposal->unread = 0;
        foreach ($comments as $key => $comment) {
          if($comment->getUnread()&&$comment->getUserId()!=$user->getId()){
            $proposal->unread ++;
          }
        }
      }
      return $this->render('homePageBundle:Estimate:estimate_list_proposals.html.twig',array('username'=>$user->getUsername(),'proposals' => $proposals));
    }
    public function validationAction(Request $request,$userp,$id){
      $em = $this->getDoctrine()->getManager();
      $estimate = $em->getRepository('CmaUserBundle:Estimate')->findOneById($id);
      $userp = $em->getRepository('CmaUserBundle:User')->findOneByUsername($userp);
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $mangoPayServices = $this->get('home_page.mangoPayServices');
      if($user->getMangoId()){
        $mangoUser = $mangoPayServices->getMangoUser($user->getMangoId());
      }else if($user->getBirthday()&&$user->getFirstname()&&$user->getName()){
        $timeStampBirthDay = $user->getBirthday()->getTimestamp();
        $created = $mangoPayServices->createMangoUser($user->getFirstname(),$user->getName(),$timeStampBirthDay,$user->getEmail());
        $user->setMangoId($created->Id);
        dump(gettype($created->Id));
      }else{
        return $this->redirectToRoute('user_info');
      }
      //$estimate->setIsValidate($userp);
      $em->persist($user);
      $em->flush();
      if (!is_object($user)||$user->getId()!=$estimate->getOwnerId()) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
      return $this->render('homePageBundle:Estimate:estimate_validation.html.twig');
    }
}