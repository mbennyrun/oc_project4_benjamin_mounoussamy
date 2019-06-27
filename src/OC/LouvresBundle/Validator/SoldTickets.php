<?php

namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SoldTickets extends Constraint
{
  public $message = "Désolé, il n'y a plus assez de billets disponibles pour valider votre commande.";
}