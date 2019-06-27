<?php

namespace OC\LouvresBundle\Recap;


use OC\LouvresBundle\Entity\Booking;

class Price
{
    const AGE_CHILD = 4;
    const PRICE_BABY = 0;
    const AGE_ADULT = 12;
    const PRICE_CHILD = 8;
    const AGE_SENIOR = 60;
    const PRICE_SENIOR = 12;
    const PRICE_ADULT = 16;
    const PRICE_REDUCE = 10;
    const PRICE_HALF_DAY = 0.5;

    public function calPrice(Booking $booking)
    {

        foreach ($booking->getTickets() as $ticket) {
            $birthdate = $ticket->getBirthDate();
            $reduce = $ticket->getReduce();
            $age = $booking->getBookingDate()->diff($birthdate)->y;

            if ($age < Price::AGE_CHILD) {
                $ticket->setPrice(Price::PRICE_BABY);
            } elseif ($age >= Price::AGE_CHILD & $age < Price::AGE_ADULT) {
                $ticket->setPrice(Price::PRICE_CHILD);
            } elseif ($age >= Price::AGE_SENIOR) {
                $ticket->setPrice(Price::PRICE_SENIOR);
            } else {
                $ticket->setPrice(Price::PRICE_ADULT);
            }

            if ($reduce == Booking::REDUCE_TRUE & $age >= Price::AGE_ADULT) {
                $ticket->setPrice(Price::PRICE_REDUCE);
            }

            if($booking->getType() == Booking::TYPE_HALF_DAY){
                $ticket->setPrice($ticket->getPrice()*Price::PRICE_HALF_DAY);
            }
        }
    }

    public function totalPrice($booking)
    {

        dump($booking);
        $total = 0;
        foreach ($booking->getTickets() as $ticket) {
            $total += $ticket->getPrice();
        }
        $booking->setTotalPrice($total);
    }
}