<?
namespace CmaUserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsSpaceValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $tab = preg_match('/\\s/', $value, $matches);
        if ($tab===1) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
    public function validatedBy()
	{
    	return 'username_nospace';
	}
}