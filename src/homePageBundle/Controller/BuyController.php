<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class BuyController extends Controller
{

    public function indexAction($pieceId)
    {
      	return $this->render('homePageBundle:Buy:index.html.twig');
    }
}
