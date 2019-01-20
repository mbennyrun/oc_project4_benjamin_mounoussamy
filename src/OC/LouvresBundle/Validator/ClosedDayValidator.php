<?php

namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;

class ClosedDayValidator extends ConstraintValidator
{
  private $requestStack;
  private $em;

  // Les arguments déclarés dans la définition du service arrivent au constructeur
  // On doit les enregistrer dans l'objet pour pouvoir s'en resservir dans la méthode validate()
  public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
  {
    $this->requestStack = $requestStack;
    $this->em           = $em;
  }

  public function validate($value, Constraint $constraint)
  {
    // Pour récupérer l'objet Request tel qu'on le connait, il faut utiliser getCurrentRequest du service request_stack
    $request = $this->requestStack->getCurrentRequest();

    // On récupère le jour de la semaine de la date de réservation
    $tabDate = explode('/', $value);
    $timestamp = mktime(0, 0, 0, $tabDate[1], $tabDate[0], $tabDate[2]);
    $weekDay = date('l', $timestamp);
    // var_dump($tabDate);
    // var_dump($weekDay);
    //die;

    // On définit les jours de la semaine où le musée est fermé
    $closedDays = array('Tuesday', 'Sunday');

    if (preg_match('#'.implode('|', $closedDays).'#', $weekDay)) {
            
            $this->context->addViolation($constraint->message);
    }
    
    //$isClosed = $this->em
    //  ->getRepository('OCLouvresBundle:Booking')
    //  ->isClosed($weekDay)
    //;
    
    //if ($isClosed) {
    //  // C'est cette ligne qui déclenche l'erreur pour le formulaire, avec en argument le message
    //  $this->context->addViolation($constraint->message);
    //}
  }
}