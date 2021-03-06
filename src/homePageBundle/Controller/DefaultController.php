<?php

namespace homePageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CmaUserBundle;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pieces = $em->getRepository('CmaUserBundle:Piece')->findBy(array('etat'=>null));
        $piecesWithUserValid = array();
        foreach ($pieces as $key => $piece) {
            $artist = $piece->getUser();
            if($artist->getIsPublic()){
                array_push($piecesWithUserValid,$piece);
            }
        }
        // dump($piecesWithUserValid);
        return $this->render('homePageBundle:Default:index.html.twig',array('pieces'=>$piecesWithUserValid));
    }
}
