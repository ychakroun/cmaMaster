<?php

namespace homePageBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CmaUserBundle\Form\ProposalType;
use CmaUserBundle\Entity\Proposal;

class ProposalController extends Controller
{
    public function showAction()
    {
    }
    public function createAction(Request $request)
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      if (!is_object($user)) {
        throw new AccessDeniedException('This user does not have access to this section.');
      }
    }
    public function deleteAction(Request $request,$id)
    {
    }
    public function updateAction(Request $request,$id)
    {
    }
    public function editAction(Request $request,$id)
    {
    }
}