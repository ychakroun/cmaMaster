<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class ConceptController extends Controller
{

    public function indexAction()
    {
      	return $this->render('homePageBundle:Concept:index.html.twig');
    }
}
