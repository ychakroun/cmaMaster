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
        if(is_string($usr->getUser())){
            $name = $usr->getUser();
        }else{
             $name = $usr->getUser()->getUsername();
             $document->name = $name;
             dump($document);
             $document->getName();
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($document);
                $em->flush();
                return $this->redirectToRoute("home_page_homepage");
            }

        }
    
        return $this->render("CmaUserBundle::imageUpload.html.twig",array('formImage' => $form->createView(),'username' => $name));
    }
}
?>