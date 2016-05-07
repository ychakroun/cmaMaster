<?php

namespace CmaAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UsersController extends Controller
{
    /**
     * @Route("/", name="cma_admin_users")
     * @Route("/users")
     */
    public function indexAction()
    {
        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('CmaAdminBundle:Users:index.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/users/remove/{id}", name="cma_admin_remove_user")
     */
    public function removeAction($id)
    {
        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(['id'=>$id]);
        if ( $user->hasRole( 'ROLE_ADMIN' ) ) {
            $this->get( 'session' )->getFlashBag()
                ->add( 'error', 'Vous ne pouvez pas supprimer un administrateur. Retirez ses droits d\'administration et réessayez.' );
        } else {
            $userManager->deleteUser($id);
            $this->get( 'session' )->getFlashBag()
                ->add( 'notice', 'Utilisateur supprimé avec success.' );
        }
        return new RedirectResponse($this->generateUrl( 'cma_admin_users'));
    }


    /**
     * @Route("/users/stat/{id}", name="cma_admin_stat_user")
     */
    public function switchStatAction($id)
    {
        $em          = $this->getDoctrine()->getEntityManager();
        $repository  = $em->getRepository('CmaUserBundle:User');
        /** @var \CmaUserBundle\Entity\User $user */
        $user        = $repository->findOneBy(['id' => $id]);
        $user->setIsPublic($user->getIsPublic() ? false : true);
        $em->flush($user);
        return new RedirectResponse($this->generateUrl( 'cma_admin_users'));
    }

    /**
     * @Route("/users/enable/{id}", name="cma_admin_enable_user")
     */
    public function enableAction($id)
    {
        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(['id'=>$id]);
        $user->setEnabled(true);
        $em          = $this->getDoctrine()->getEntityManager();
        $em->flush($user);
        return new RedirectResponse($this->generateUrl( 'cma_admin_users'));
    }
    /**
     * @Route("/users/view/{id}", name="cma_admin_view_user")
     */
    public function viewAction($id)
    {
        $em          = $this->getDoctrine()->getEntityManager();
        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(['id'=>$id]);
        $pieces = $pieces = $em->getRepository('CmaUserBundle:Piece')->findBy(array('user'=>$user),null,5,null);
        return $this->render('CmaAdminBundle:Users:view.html.twig', ['user' => $user,'pieces' => $pieces]);
    }
}
