<?php

namespace CmaUserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use CmaUserBundle\Form\ProfileType;
use CmaUserBundle\Entity\Profile;
use CmaUserBundle\Form\FilterPiecesType;

class ProfileController extends Controller
{
    /**
     * Show the user
     */
    public function showAction($username)
    {
        if (is_string($username) && $username !== null) {
            $user = $this->get('fos_user.user_manager')->findUserByUsername($username);
        }else{
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        else
        {
            $isartist = $user->hasRole('ROLE_ARTIST');
        }
        if(!$isartist==true){
            throw $this->createNotFoundException('This user is not an artist');
        }
        $em = $this->getDoctrine()->getManager();
        $pieces = $pieces = $em->getRepository('CmaUserBundle:Piece')->findBy(array('user'=>$user),null,5,null);
        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'artist' => $user,
            'pieces'=> $pieces
        ));
    }

    public function galleryAction(Request $request,$username,$topfilter)
    {
        $urlParameter = $request->query->get('filter_pieces');
        $mediums = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findSomeMedium(0);
        $piecesQuery = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findWithUrl(1,$topfilter,$urlParameter);
        $form = $this->createForm(FilterPiecesType::class,array($mediums));
        $form->handleRequest($request);
        if (is_string($username) && $username !== null) {
            $user = $this->get('fos_user.user_manager')->findUserByUsername($username);
        }else{
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        else
        {
            $isartist = $user->hasRole('ROLE_ARTIST');
        }
        if(!$isartist==true){
            throw $this->createNotFoundException('This user is not an artist');
        }
        $em = $this->getDoctrine()->getManager();
        $piecesArtist = $pieces = $em->getRepository('CmaUserBundle:Piece')->findByUser($user);
        $piecesSort = array();
        foreach ($piecesArtist as $key => $pieceArtist) {
            if(!empty($piecesQuery)){
                foreach ($piecesQuery as $key => $pieceQuery) {
                    if($pieceArtist->getId()==$pieceQuery->getId()){
                        array_push($piecesSort, $pieceArtist);
                    }
                }
            }
        }
        return $this->render('homePageBundle:Profile:show_gallery.html.twig', array(
            'artist' => $user,
            'pieces'=> $piecesSort,
            'formfilter' => $form->createView()
        ));
    }
    public function opinionsAction($username){
        $em = $this->getDoctrine()->getManager();
        if (is_string($username) && $username !== null) {
            $user = $this->get('fos_user.user_manager')->findUserByUsername($username);
        }else{
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        return $this->redirectToRoute('artist_profile',array('username'=>$username));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface || !$user->hasRole('ROLE_ARTIST') ) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userprofile = $this->getUser()->getProfile();
        if(!is_object($userprofile)){
            $userprofile = new Profile();
            $this->getDoctrine()->getManager()->persist($userprofile);
            $this->getDoctrine()->getManager()->flush();
            $user->setProfile($userprofile);
        }
        $em = $this->getDoctrine()->getManager();
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        $form = $this->createForm(ProfileType::class, $userprofile);
        //$form = $formFactory->createForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $formTagS = $userprofile->getTags();
            $existingTagS = $this->getDoctrine()->getRepository('CmaUserBundle:Tag')->findAll();
            foreach ($formTagS as $key => $formTag) {
                foreach ($existingTagS as $key => $existingTag) {
                    if($formTag->getName() === $existingTag->getName()) {
                        $userprofile->removeTag($formTag);
                        $userprofile->addTag($existingTag);
                    }
                }
            }
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);
            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('artist_edit');

            }

            //$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $this->redirectToRoute('artist_edit');
        }
        $pieces = $pieces = $em->getRepository('CmaUserBundle:Piece')->findByUser($user);
        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
            'artist' => $user,
            'username'=>$user->getUsername(),
            'profile'=>$userprofile,
            'pieces' => $pieces
        ));
    }
}
