<?php


namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotPastDayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {

        // On définit la date du jour
        $currentDate = date("Ymd");

        if ($currentDate > $value->format("Ymd")) {

            $this->context->addViolation($constraint->message);
        }
    }
}