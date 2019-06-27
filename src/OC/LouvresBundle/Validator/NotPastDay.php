<?php


namespace OC\LouvresBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotPastDay extends Constraint
{
    public $message = "Vous ne pouvez pas réserver de billet pour un jour déjà passé.";
}