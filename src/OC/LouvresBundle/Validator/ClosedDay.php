<?php

namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ClosedDay extends Constraint
{
  public $message = "Vous ne pouvez pas réserver de billet pour ce jour car le musée est fermé.";

  public function validatedBy()
  {
    return 'oc_louvres_closedday'; // Ici, on fait appel à l'alias du service
  }
}