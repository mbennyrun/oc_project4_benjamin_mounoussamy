<?php


namespace OC\LouvresBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotAfterFourteen extends Constraint
{
    public $message = "Vous ne pouvez pas réserver de billet Demi-Journée après 14h00.";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}