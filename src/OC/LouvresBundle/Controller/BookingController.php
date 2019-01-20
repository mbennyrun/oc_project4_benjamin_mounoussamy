<?php

namespace OC\LouvresBundle\Controller;

use OC\LouvresBundle\Entity\booking;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use OC\LouvresBundle\Form\bookingType;

class BookingController extends Controller
{  
    public function bookingAction(Request $request)
  {
    $booking = new Booking();
    $form = $this->createForm(bookingType::class, $booking);
    
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($booking);
      $em->flush();

    }

    return $this->render('OCLouvresBundle:Booking:booking.html.twig', array(
      'Bookingform' => $form->createView(),
    ));
  }
}
