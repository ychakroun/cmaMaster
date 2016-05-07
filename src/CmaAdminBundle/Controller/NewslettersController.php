<?php

namespace CmaAdminBundle\Controller;

use CmaAdminBundle\Entity\Newsletter;
use CmaAdminBundle\Form\NewsletterType;
use CmaUserBundle\Form\EstimateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/newsletters")
 */
class NewslettersController extends Controller
{
    /**
     * @Route("/", name="cma_admin_newsletters")
     */
    public function indexAction()
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaAdminBundle:Newsletter');
        /** @var \CmaAdminBundle\Entity\Newsletter $newsletter */
        $newsletters       = $repository->findAll();
        return $this->render('CmaAdminBundle:Newsletters:index.html.twig',['newsletters' => $newsletters]);
    }

    /**
     * @Route("/create", name="cma_admin_newsletters_create")
     */
    public function createAction(Request $request)
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaAdminBundle:Newsletter');
        /** @var \CmaAdminBundle\Entity\Newsletter $newsletter */
        $newsletter  = new Newsletter();

        $formNewsletter = $this->createForm(NewsletterType::class,$newsletter);
        $formNewsletter->handleRequest($request);
        if ($formNewsletter->isValid()) {
            $em->persist($newsletter);
            $em->flush();
            return new RedirectResponse($this->generateUrl('cma_admin_newsletters_view',['id'=>$newsletter->getId()]));
        }
        return $this->render('CmaAdminBundle:Newsletters:create.html.twig',['form_newsletter' => $formNewsletter->createView()]);
    }

    /**
     * @Route("/view/{id}", name="cma_admin_newsletters_view")
     */
    public function viewAction(Request $request,$id)
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaAdminBundle:Newsletter');
        /** @var \CmaAdminBundle\Entity\Newsletter $newsletter */
        $newsletter       = $repository->find($id);
        return $this->render('CmaAdminBundle:Newsletters:view.html.twig',['newsletter' => $newsletter]);
    }
}
