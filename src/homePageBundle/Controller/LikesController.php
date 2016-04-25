<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CmaUserBundle\Entity\Likes;

class LikesController extends Controller
{
    public function toggleAction(Request $request,$artistId)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $artist = $em->getRepository('CmaUserBundle:User')->findOneById($artistId);
        $likes = $user->getLikes();
        if($likes!==null){
            foreach ($likes as $key => $like) {
               $doesExist = $like->getArtist();
               if($doesExist===$artist){
                    return $this->removeAction($request,$user,$like);
                }
            }
        }
        return $this->addAction($request,$user,$artist);
    }
    public function addAction($request,$user,$artist){
        $em = $this->getDoctrine()->getEntityManager();
        $like = new Likes();
        $like->setUser($user);
        $like->setArtist($artist);
        $user->addLike($like);
        $em->persist($user);
        $em->flush();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }
    public function removeAction($request,$user,$like){
        $em = $this->getDoctrine()->getEntityManager();
        $user->removeLike($like);
        $em->persist($user);
        $em->remove($like);
        $em->flush();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }
}