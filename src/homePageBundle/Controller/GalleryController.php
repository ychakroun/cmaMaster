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
        $mediums = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findSomeMedium();
        dump($mediums);
    	$pieces = $this->getDoctrine()->getRepository('CmaUserBundle:Piece')->findWithUrl($page,$topfilter,$urlParameter);
        $piecesToShow = array();
        $i = 0;
        while ( $i < 5 && $i < count($pieces)) {
            array_push($piecesToShow, $pieces[$i]);
            $i++;
            dump($i);
        }
        dump($pieces);
    	$form = $this->createForm(FilterPiecesType::class,array('data'=>$mediums));
        $form->handleRequest($request);
        $uri = $request->getRequestUri();
        if(strripos($uri,'?')){
            $uri = substr($uri, strripos($uri,'?'),strlen($uri));
        }else{
            $uri = null;
        }
        $nbAllPages = ceil(count($pieces)/6);
      	return $this->render('homePageBundle:Gallery:index.html.twig',array('topfilter'=>$topfilter,
               'nbPage'=>$page,
               'formfilter'=>$form->createView(),
               'pieces'=>$piecesToShow,
               'mediums'=>$mediums,
               'uri'=>$uri,
               'nbAllPages'=>$nbAllPages
        ));
    }
}