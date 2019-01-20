<?php

namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;

class PublicHolidayValidator extends ConstraintValidator
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
    $booking = $this->context->getObject();

    // Pour récupérer l'objet Request tel qu'on le connait, il faut utiliser getCurrentRequest du service request_stack
    $request = $this->requestStack->getCurrentRequest();

    // On définit le fuseau horaire sur Paris
    date_default_timezone_set('Europe/Paris');
    
    // On définit une fonction pour faire un explode avec plusieurs delimiter
    function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
    }
    
    // On récupère le jour de la réservation
    $tabBookingDay = explode('/', $value);
    $bookingDay = mktime(0, 0, 0, $tabBookingDay[1], $tabBookingDay[0], $tabBookingDay[2]);
    
    // On récupère la date du jour
    $currenttimestamp = date("Y-m-d H:i:s");
    $tabCurrentDay = multiexplode(array('-',':'," "), $currenttimestamp);
    $currentDay = mktime(0, 0, 0, $tabCurrentDay[1], $tabCurrentDay[2], $tabCurrentDay[0]);
    
    //On récupère l'heure du jour
    $currentHour = mktime($tabCurrentDay[3], $tabCurrentDay[4], $tabCurrentDay[5], $tabCurrentDay[1], $tabCurrentDay[2], $tabCurrentDay[0]);
    
    // On définit l'heure limite pour le tarif Demi-journée
    $limitHourtimestamp = date("Y-m-d 14:00:00");
    $tabLimitHour = multiexplode(array('-',':'," "), $limitHourtimestamp);
    $limitHour = mktime($tabLimitHour[3], $tabLimitHour[4], $tabLimitHour[5], $tabLimitHour[1], $tabLimitHour[2], $tabLimitHour[0]);
    
    // On définit les jours férié
    $publicHolidays = array('01/05', '01/11', '25/12');
    
    // var_dump($publicHolidays);
    // var_dump($value);
    // var_dump($tabBookingDay);
    // var_dump($bookingDay);
    // var_dump($currenttimestamp);
    // var_dump($tabCurrentDay);
    // var_dump($currentDay);
    // var_dump($currentHour);
    // var_dump($tabLimitHour);
    // var_dump($limitHour);
    // die;
    
    if (preg_match('#'.implode('|', $publicHolidays).'#', $value)) {
            
            $this->context->addViolation($constraint->message0);
    }
    
    if ($currentDay > $bookingDay) {
        
            $this->context->addViolation($constraint->message1);
    }
    
    if ($currentDay == $bookingDay) {
        
        if ($currentHour > $limitHour && $booking->getType() == 'Demi-journée') {
            
            $this->context->addViolation($constraint->message2);
        }
    }
  }
}