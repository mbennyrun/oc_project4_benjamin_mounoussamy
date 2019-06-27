<?php


namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use OC\LouvresBundle\Entity\Booking;

class NotAfterFourteenValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if(!$value instanceof  Booking){
            throw new \LogicException();
        }

        // On définit le fuseau horaire sur Paris
        date_default_timezone_set('Europe/Paris');

        // On définit la date du jour
        $currentDate = date("Ymd");

        // On définit l'heure du jour
        $currentHour = date("H:i");



        if ($currentDate == $value->getBookingDate()->format("Ymd")) {

            if ($currentHour >= Booking::FULL_DAY_MAX_HOUR && $value->getType() == Booking::TYPE_HALF_DAY) {

                $this->context->addViolation($constraint->message);
            }
        }
    }
}