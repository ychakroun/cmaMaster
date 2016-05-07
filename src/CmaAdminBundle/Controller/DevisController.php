<?php

namespace CmaAdminBundle\Controller;

use CmaUserBundle\Form\EstimateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/devis")
 */
class DevisController extends Controller
{
    /**
     * @Route("/", name="cma_admin_devis")
     */
    public function indexAction()
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaUserBundle:Estimate');
        /** @var \CmaUserBundle\Entity\Estimate $devis */
        $devis       = $repository->findAll();
        return $this->render('CmaAdminBundle:Devis:index.html.twig', ['devis' => $devis]);
    }

    /**
     * @Route("/view/{id}", name="cma_admin_view_devis")
     */
    public function viewAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaUserBundle:Estimate');
        /** @var \CmaUserBundle\Entity\Estimate $devis */
        $devis       = $repository->find($id);
        $repository  = $em->getRepository('CmaUserBundle:User');
        $user        = $repository->find($devis->getOwnerId());
        return $this->render('CmaAdminBundle:Devis:view.html.twig', ['devis' => $devis, 'user' => $user]);
    }

    /**
     * @Route("/edit/{id}", name="cma_admin_edit_devis")
     */
    public function editAction(Request $request,$id)
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaUserBundle:Estimate');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        /** @var \CmaUserBundle\Entity\Estimate $devis */
        $devis = $repository->findOneById($id);
        $user->removeEstimate($devis);
        $formEstimate = $this->createForm(EstimateType::class,$devis);
        $formEstimate->handleRequest($request);
        if ($formEstimate->isValid() && $formEstimate->get('save')->isClicked()) {
            $devis->setIsPublic(false);
            if($devis->getImage1()->getPath()==null){
                $devis->setImage1(null);
            }
            if($devis->getImage2()->getPath()==null){
                $devis->setImage2(null);
            }
            if($devis->getImage3()->getPath()==null){
                $devis->setImage3(null);
            }
            $em->persist($devis);
            $user->addEstimate($devis);
            $em->persist($user);
            $em->flush();
        }

        return $this->render('CmaAdminBundle:Devis:edit.html.twig', ['username'=>$user->getUsername(),'devis' => $devis, 'formEstimate' => $formEstimate->createView()]);
    }

    /**
     * @Route("/enable/{id}", name="cma_admin_enable_devis")
     */
    public function enableAction($id)
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaUserBundle:Estimate');
        /** @var \CmaUserBundle\Entity\Estimate $devis */
        $devis       = $repository->find($id);
        //@todo: enable the devis?
        $devis->setIsValidate(true);
        $em->flush($devis);
        return new RedirectResponse($this->generateUrl( 'cma_admin_edit_devis',['id'=>$id]));
    }
}
