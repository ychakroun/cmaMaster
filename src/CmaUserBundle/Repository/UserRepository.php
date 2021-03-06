<?php
namespace CmaUserBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
  public function myFindAllArtist()
  {
    $queryBuilder = $this->createQueryBuilder('a');
    // On n'ajoute pas de critère ou tri particulier, la construction
    // de notre requête est finie
    // On récupère la Query à partir du QueryBuilder
    $query = $queryBuilder->getQuery();
    // On récupère les résultats à partir de la Query
    $results = $query->getResult();
    // On retourne ces résultats
    return $results;
  }
 /**
 * @param string $role
 *
 * @return array
 */
  public function findByRole($role)
  {
    $qb = $this->createQueryBuilder('a');
    $qb->select('u')
        ->from($this->_entityName, 'u')
        ->leftJoin('u.groups', 'g')
        ->where($qb->expr()->orX(
            $qb->expr()->like('u.roles', ':roles'),
            $qb->expr()->like('g.roles', ':roles')
        ))
        ->setParameter('roles', '%"'.$role.'"%');

    return $qb->getQuery()->getResult();
  }
  /**
 * @param string $role
 *
 * @return array
 */
  public function findByRoleAndOffset($role,$offset)
  {
    $offset = $offset*6;
    $artists = array();
    $qb = $this->createQueryBuilder('a');
    $qb->select('u')
        ->from($this->_entityName, 'u')
        ->leftJoin('u.groups', 'g')
        ->where($qb->expr()->orX(
            $qb->expr()->like('u.roles', ':roles'),
            $qb->expr()->like('g.roles', ':roles')
        ))
        ->setParameter('roles', '%"'.$role.'"%');
    foreach ($qb->getQuery()->getResult() as $key => $artist) {
      if(($key>=$offset)&&($key<=$offset+6)&&$artist->getIsPublic()&&$artist->getProfile()){
        array_push($artists, $artist);
      }
    }
    return $artists;
  }
    /**
     * @param string $role
    *
    * @return array
    */
    public function findByRoleIndex($role)
    {
    $qb = $this->_em->createQueryBuilder();
    $qb->select('u')
        ->from($this->_entityName, 'u')
        ->leftJoin('u.groups', 'g')
        ->where($qb->expr()->orX(
            $qb->expr()->like('u.roles', ':roles'),
            $qb->expr()->like('g.roles', ':roles')
        ))
        ->setMaxResults(4)
        ->setParameter('roles', '%"'.$role.'"%');

    return $qb->getQuery()->getResult();
    }
    
  public function myFindName($username)
  {
    $qb = $this->createQueryBuilder('a');
    $qb->select('u')->from($this->_entityName, 'u')->leftJoin('u.groups', 'g')->where('u.username = :username')->setParameter('username', $username);
    return $qb->getQuery()->getResult();
  }
}
