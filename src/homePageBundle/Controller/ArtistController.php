<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class ArtistController extends Controller
{
    public function viewAction($id)
    {
      return $this->render('homePageBundle:Artist:view.html.twig',array('id'  => $id));
    }
    public function indexAction()
    {
    $repository = $this->getDoctrine()->getManager()->getRepository('CmaUserBundle:User');
		$listArtists = $repository->findByRole('ROLE_ARTIST');
      	return $this->render('homePageBundle:Artist:index.html.twig',array('listArtists' => $listArtists));
    }
}