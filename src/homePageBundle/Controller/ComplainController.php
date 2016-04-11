<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Entity\Complain;
use CmaUserBundle\Form\ComplainType;

class ComplainController extends Controller
{
    public function createAction(Request $request,$id) 
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->get('security.token_storage')->getToken()->getUser();
    	$proposal = $em->getRepository('CmaUserBundle:Proposal')->findOneById($id);
      	if (!is_object($user)||$proposal->getUserId()!=$user->getId()&&$em->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId())->getOwnerId()!=$user->getId()) {
      	  throw new AccessDeniedException('This user does not have access to this section.');
      	}
      	$complain = new Complain();
      	if($user->getFirstname()){
      		$complain->setFirstname($user->getFirstname());
      	}
      	if($user->getName()){
      		$complain->setName($user->getName());
      	}
      	$complain->setUserId($user->getId());
      	$complain->setUsername($user->getUsername());
      	$complain->setMailAddress($user->getEmail());
      	$complain->setProposal($proposal);
      	$complain->setProjectTitle($em->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId())->getTitle());
      	if($proposal->getUserId()==$user->getId()){
      		$complain->setOtherUserId($em->getRepository('CmaUserBundle:Estimate')->findOneById($proposal->getEstimateId())->getOwnerId());
      		$complain->otherusername = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->getOtherUserId())->getUsername();
      	}else{
      		$complain->setOtherUserId($proposal->getUserId());
      		$complain->otherusername = $em->getRepository('CmaUserBundle:User')->findOneById($proposal->getUserId())->getUsername();
      	}
      	$formComplain = $this->createForm(ComplainType::class,$complain);
      	$formComplain->handleRequest($request);
      	if ($formComplain->isValid()) {
          if(is_null($complain->getImage()->getPath())){
            $complain->setImage(null);
          }
      		$em->persist($complain);
      		$em->flush();
      		$login = $this->generateUrl('fos_user_security_login');
      		$url = $this->generateUrl('artist_proposal_show',array('username' => $user->getUsername(),'id'=>$proposal->getId()));
      		$message = \Swift_Message::newInstance()
        	->setSubject('Reclamation sur la proposition n°'.$proposal->getId().' de l\'artiste '.$complain->otherusername)
        	->setFrom($user->getEmail())
        	->setTo('contact@custommyart.com')
        	->setBody(
            	$this->renderView(
                	 'email/complain.html.twig',
                	array('login'=>$login,'user' => $user,'proposal'=>$proposal,'complain'=>$complain,'url'=>$url)
            	),
            	'text/html'
        	);
	        $this->get('mailer')->send($message);
      		return $this->redirectToRoute('user_finish_project');
      	}
      return $this->render('homePageBundle:Proposal:proposal_complain.html.twig',array('formComplain'  => $formComplain->createview()));
    }

}