<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\FilterPiecesType;

class GalleryController extends Controller
{
    public function viewAction($id)
    {
      return $this->render('homePageBundle:Gallery:view.html.twig',array('id'  => $id));
    }
    public function indexAction(Request $request,$page,$topfilter)
    {
        $urlParameter = $request->query->get('filter_pieces');
        dump( $urlParameter);
        $mediums = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findSomeMedium(0);
    	$pieces = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findWithUrl($page,$topfilter,$urlParameter);
    	$form = $this->createForm(FilterPiecesType::class,array($mediums));
        $form->handleRequest($request);
      	return $this->render('homePageBundle:Gallery:index.html.twig',array('formfilter'=>$form->createView(),'pieces'=>$pieces,'mediums'=>$mediums));
    }
}