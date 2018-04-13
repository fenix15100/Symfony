<?php


namespace Triburch\Backend\JuegosBundle\Validators;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class ValIdiomaValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        $idiomas = array("es","en","fr","ca");
        if ($value == false) return true;
        if (in_array($value,$idiomas )) return true;
        $this->context->addViolation($constraint->message);
        return false;
    }

}