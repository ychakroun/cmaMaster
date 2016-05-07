<?php

namespace CmaAdminBundle\Twig;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

/**
 * Class GeneralExtension
 * @package Bundle\FrontBundle\Twig
 */
class AdminExtension extends \Twig_Extension
{
    protected $em;

    public function setEntityManager(ObjectManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'truncate'    => new \Twig_Filter_Method( $this, 'twig_truncate_filter' )
        );
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()

    {
        return array(
            'getUserById'                => new \Twig_Function_Method( $this, 'getUserById' ),
        );
    }

    /**
     * @param        $value
     * @param int    $length
     * @param bool   $preserve
     * @param string $separator
     *
     * @return string
     */
    function twig_truncate_filter( $value, $length = 30, $preserve = false, $separator = '...')
    {
        if (mb_strlen($value)) {
            if ($preserve) {
                if (false === ($breakpoint = mb_strpos($value, ' ',$length))) {
                    return $value;
                }
                $length = $breakpoint;
            }
            $_separator= '';
            if(rtrim(mb_strlen($value) > $length)) {
                $_separator = $separator;
            }
            return rtrim(mb_substr($value, 0, $length)).$_separator;
        }
        return $value;
    }

    /**
     * @param $id
     */
    function getUserById($id){
        $repository = $this->em->getRepository('CmaUserBundle:User');
        return $repository->findOneBy(['id' => $id]);
    }
    /**
     * Returns the name of the extension.
     * @return string The extension name
     */
    public function getName()
    {
        return 'admin_extension';
    }

}