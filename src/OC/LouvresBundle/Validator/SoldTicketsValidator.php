<?php

namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;
use OC\LouvresBundle\Entity\Booking;

class SoldTicketsValidator extends ConstraintValidator
{
  private $em;

  // Les arguments déclarés dans la définition du service arrivent au constructeur
  // On doit les enregistrer dans l'objet pour pouvoir s'en resservir dans la méthode validate()
  public function __construct(EntityManagerInterface $em)
  {
    $this->em           = $em;
  }

  public function validate($value, Constraint $constraint)
  { 
    $object = $this->context->getObject();
    
    // On récupère le nombre de billets que le client veut commander
    $tickets = $object->getTicketsNumber();
    
    // On récupère la date de réservation
    $bookingDate = $object->getBookingDate();

    // On vérifie si il reste assez de billets disponibles
    $sold_tickets = $this->em
      ->getRepository('OCLouvresBundle:Booking')
      ->isBooked($bookingDate);

    function isFull($sold_tickets, $tickets)
    {
      if ($sold_tickets + $tickets > Booking::MAX_SOLD_TICKETS) {

          return true;
      }
      else {
          return false;
      }
    }

    $isFull = isFull($sold_tickets, $tickets);

    if ($isFull) {
      // C'est cette ligne qui déclenche l'erreur pour le formulaire, avec en argument le message
      $this->context->addViolation($constraint->message);
    }
  }
}