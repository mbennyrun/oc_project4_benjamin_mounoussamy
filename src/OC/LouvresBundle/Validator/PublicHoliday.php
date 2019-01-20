<?php

namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PublicHoliday extends Constraint
{
  public $message0 = "Vous ne pouvez pas réserver de billet pour un des jours fériés suivants : 01/05, 01/11, 25/12.";
  
  public $message1 = "Vous ne pouvez pas réserver de billet pour un jour déjà passé.";
  
  public $message2 = "Vous ne pouvez pas réserver de billet Demi-Journée après 14h00.";

  public function validatedBy()
  {
    return 'oc_louvres_publicholiday'; // Ici, on fait appel à l'alias du service
  }
}