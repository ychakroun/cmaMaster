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
use Symfony\Component\Security\Core\Exception\HttpNotFoundException;
use CmaUserBundle\Form\ProfileType;
use CmaUserBundle\Entity\Tag;
use CmaUserBundle\Entity\Profile;

class ProfileController extends Controller
{
    /**
     * Show the user
     */
    public function showAction($username)
    {
        $user = $this->get('fos_user.user_manager')->findUserByUsername($username);
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }else
        {
            $isartist = $user->hasRole('ROLE_ARTIST');
        }
        if(!$isartist==true){
            throw $this->createNotFoundException('This user is not an artist');
        }

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $userprofile = $this->getUser()->getProfile();
        if (null !== $userprofile) {
            $initialTags = $this->get('home_page.userServices')->allProfile()->getTags();
        }else{
            $userprofile = new Profile();
            $userManager = $this->get('fos_user.user_manager');
            $user->setProfile($userprofile);
            $userManager->updateUser($user);
            $initialTags = null;
        }
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        $existingTagS = $this->getDoctrine()->getRepository('CmaUserBundle:Tag')->findAll();
        $form = $this->createForm(ProfileType::class, $userprofile);
        //$form = $formFactory->createForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $event = new FormEvent($form, $request);
            if($form->getData()->getimageHeader()->getPath()){
                $userprofile->removeImageHeader();
            }
            if($form->getData()->getimage1()->getPath()){
                 $userprofile->removeImage1();
            }
            if($form->getData()->getimage2()->getPath()){
                 $userprofile->removeImage2();
            }
            if($form->getData()->getimage3()->getPath()){
                 $userprofile->removeImage3();
            }
            if(null !== $initialTags){
            $formTagS = $userprofile->getTags();
                foreach ($formTagS as $key => $formTag) {
                    if($formTag===null||$formTag==''){
                        $userprofile->removeTag($formTag);
                    }
                    foreach ($existingTagS as $key => $existingTag) {
                        if($formTag->getName() === $existingTag->getName()) {
                            $userprofile->removeTag($formTag);
                            $userprofile->addTag($existingTag);
                        }
                        dump($existingTag->getId());
                        dump($existingTag->getName());
                        dump($formTag->getId());
                        dump($formTag->getName());
                        if($formTag->getId() === $existingTag->getId()) {
                            if($formTag->getName()!=$existingTag->getName()){
                                dump('nip');
                            }
                            //$userprofile->removeTag($formTag);
                            //$newTag = new Tag();
                            //$newTag->setName($formTag);
                            //$userprofile->addTag($newTag); 
                        }
                    }
                }
            }
            dump($userprofile);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);
            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('artist_edit');
                
            }

            //$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $this->redirectToRoute('artist_edit');
        }
        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
            'username'=>$user->getUsername(),
            'user'=>$user,
            'profile'=>$userprofile
        ));
    }
}
