<?
namespace CmaUserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsSpace extends Constraint
{
    public $message = 'Interdit aux espaces dans le nom d\'utilisateur';
}