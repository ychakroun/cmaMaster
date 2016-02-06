<?php

namespace homePageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CmaUserBundle;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('homePageBundle:Default:index.html.twig');
    }
}
