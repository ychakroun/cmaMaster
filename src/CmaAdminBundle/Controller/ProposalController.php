<?php

namespace CmaAdminBundle\Controller;

use CmaUserBundle\Entity\Comment;
use CmaUserBundle\Form\CommentType;
use CmaUserBundle\Form\EstimateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/proposal")
 */
class ProposalController extends Controller
{
    /**
     * @Route("/view/{id}", name="cma_admin_view_proposal")
     */
    public function viewAction(Request $request,$id)
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaUserBundle:Proposal');
        /** @var \CmaUserBundle\Entity\Proposal $proposal */
        $proposal       = $repository->find($id);
        $repository  = $em->getRepository('CmaUserBundle:Estimate');
        /** @var \CmaUserBundle\Entity\Estimate $devis */
        $devis       = $repository->find($proposal->getEstimateId());

        /** @var \CmaUserBundle\Entity\User $user */
        $user        = $em->getRepository('CmaUserBundle:User')->findOneBy(['id' => $id]);
        $comment = new Comment();
        $formComment = $this->createForm(CommentType::class,$comment);
        $formComment->handleRequest($request);
        if($formComment->isValid()){
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $comment->setUserId($user->getId());
            $comment->setOwnerComment(true);
            $comment->setUnread(true);
            $em->persist($comment);
            $proposal->addComment($comment);
            $em->persist($proposal);
            $em->flush();
            $comment=new Comment();
            $formComment = $this->createForm(CommentType::class,$comment);
        }

        return $this->render('CmaAdminBundle:Proposal:view.html.twig',
            [
                'proposal' => $proposal,
                'devis'    => $devis,
                'user'     => $user,
                'form'     => $formComment->createView()
            ]);
    }

    /**
         * @Route("/comment/remove/{id}/{comment_id}", name="cma_admin_remove_comment")
     */
    public function removeAction(Request $request,$id, $comment_id)
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaUserBundle:Proposal');
        /** @var \CmaUserBundle\Entity\Proposal $proposal */
        $proposal = $repository->find($id);
        /** @var \CmaUserBundle\Entity\Comment $comment */
        $comment = $em->getRepository('CmaUserBundle:Comment')->find($comment_id);
        $proposal->removeComment($comment);
        $em->persist($comment);
        $em->flush();
        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }

}
