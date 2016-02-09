<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends Controller
{
    public function viewAction($id)
    {
      return $this->render('homePageBundle:Advert:view.html.twig',array('id'  => $id));
    }
    public function indexAction()
    {
      return $this->render('homePageBundle:Advert:index.html.twig');
    }
}