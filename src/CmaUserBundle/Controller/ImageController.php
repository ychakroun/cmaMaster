<?php
namespace CmaUserBundle\Controller;

use CmaUserBundle\Form\ImageType;
use CmaUserBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserInterface;

class ImageController extends Controller
{
    public function uploadAction(Request $request)
    {
        $document = new Image();
        $usr = $this->get('security.token_storage')->getToken();
        $form = $this->createForm(ImageType::class, $document);
        $form->handleRequest($request);
        if ($this->has('security.csrf.token_manager')) {
            $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
        } else {
            // BC for SF < 2.4
            $csrfToken = $this->has('form.csrf_provider')
                ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
                : null;
        }
        if(is_string($usr->getUser())){
            $document->name = $usr->getUser();
        }else{
             $document->name = $usr->getUser()->getUsername();
             dump($document);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($document);
                $em->flush();
                return $this->redirectToRoute("home_page_homepage");
            }

        }
    
        return $this->render("CmaUserBundle::imageUpload.html.twig",array('formImage' => $form->createView(),'csrf_token' => $csrfToken,"username"=>$usr->getUser()->getUsername()));
    }
}
?>