<?php


namespace OC\LouvresBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotHolidayValidator extends ConstraintValidator
{
    // On définit les jours fériés
    public static function getHolidays($year = null)
    {
        if ($year === null)
        {
            $year = intval(strftime('%Y'));
        }

        $easterDate = easter_date($year);
        $easterDay = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear = date('Y', $easterDate);

        $holidays = array(
            // Jours feries fixes
            mktime(0, 0, 0, 1, 1, $year),// 1er janvier
            mktime(0, 0, 0, 5, 1, $year),// Fete du travail
            mktime(0, 0, 0, 5, 8, $year),// Victoire des allies
            mktime(0, 0, 0, 7, 14, $year),// Fete nationale
            mktime(0, 0, 0, 8, 15, $year),// Assomption
            mktime(0, 0, 0, 11, 1, $year),// Toussaint
            mktime(0, 0, 0, 11, 11, $year),// Armistice
            mktime(0, 0, 0, 12, 25, $year),// Noel

            // Jour feries qui dependent de paques
            mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear),// Lundi de paques
            mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear),// Ascension
            mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear), // Pentecote
        );

        sort($holidays);

        return $holidays;
    }

    public function validate($value, Constraint $constraint)
    {
        // On récupère les jours fériés de l'année de la date de réservation
        $publicHolidays = getHolidays($value->format("Y"));

        // On définit le jour de réservation
        $date = $value->format("Y-m-d 0:0:0");
        $Boooking_date = strtotime($date);

        if (preg_match('#'.implode('|', $publicHolidays).'#', $Boooking_date)) {

            $this->context->addViolation($constraint->message);
        }
    }
}