<?php


namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotSundayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {

        // On récupère le jour de la semaine de la date de réservation
        $weekDay = date('l', $value->getTimestamp());

        // On définit le jour de la semaine où le musée est fermé
        $Sunday = 'Sunday';

        if ($weekDay == $Sunday) {

            $this->context->addViolation($constraint->message);
        }
    }
}