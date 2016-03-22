<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class HelpController extends Controller
{

    public function indexAction()
    {
      	return $this->render('homePageBundle:Help:index.html.twig');
    }
}
