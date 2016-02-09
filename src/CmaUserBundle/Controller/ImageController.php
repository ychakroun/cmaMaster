<?php
namespace CmaUserBundle\Controller;

use CmaUserBundle\Form\ImageType;
use CmaUserBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ImageController extends Controller
{
    public function uploadAction(Request $request)
    {
        $document = new Image();
    
        $form = $this->createForm(ImageType::class, $Image);
    
        $form->handleRequest($request);
    
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
    
            $em->persist($document);
            $em->flush();
    
            return $this->redirectToRoute("home_page_homepage");
        }
    
        return $this->render("CmaUserBundle::imageUpload.html.twig",array('formImage' => $form->createView()));
    }
}
?>