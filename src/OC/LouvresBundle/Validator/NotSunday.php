<?php


namespace OC\LouvresBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotSunday extends Constraint
{
    public $message = "Vous ne pouvez pas réserver de billet pour ce jour car le musée est fermé le dimanche.";

}