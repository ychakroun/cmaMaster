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
        $mediums = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findSomeMedium(0);
    	$pieces = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findWithUrl($page,$topfilter,$urlParameter);
    	$form = $this->createForm(FilterPiecesType::class,array('data'=>$mediums));
        $form->handleRequest($request);
        $uri = $request->getRequestUri();
        if(strripos($uri,'/')>0){
            $uri = substr($uri, strripos($uri,'/'),strlen($uri));
        }else{
            $uri = null;
        }
      	return $this->render('homePageBundle:Gallery:index.html.twig',array('topfilter'=>$topfilter,'nbPage'=>$page,'formfilter'=>$form->createView(),'pieces'=>$pieces,'mediums'=>$mediums,'uri'=>$uri));
    }
}