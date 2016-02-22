<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\EstimateType;
use CmaUserBundle\Entity\Estimate;

class EstimateController extends Controller
{
    public function viewAction($id)
    {
      return $this->render('homePageBundle:Estimate:view.html.twig',array('id'  => $id));
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($estimate);
            $user->addEstimate($estimate);
            $em->persist($user);
            dump($user->getEstimates());
            //$em->flush();
            return $this->redirectToRoute("user_parameter");
        }
      return $this->render('homePageBundle:Estimate:estimate_create.html.twig',array('username'=>$user->getUsername(),'formEstimate' => $formEstimate->createView()));
    }
    public function editAction()
    {
      return $this->render('homePageBundle:Estimate:estimate_edit.html.twig',array('username'=>$user->getUsername(),'formEstimate' => $formEstimate));
    }
}