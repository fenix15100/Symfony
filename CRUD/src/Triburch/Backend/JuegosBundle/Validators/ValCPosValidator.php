<?php

namespace Triburch\Backend\JuegosBundle\Validators;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValCPosValidator extends ConstraintValidator
{
	public function validate($value, Constraint $constraint)
	{
		if ($value == false) return true;
		if (preg_match('/^[0-9]{5}$/i', $value)) return true;
		$this->context->addViolation($constraint->message);
		return false;
	}
}
