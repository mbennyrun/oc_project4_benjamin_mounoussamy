<?php

namespace OC\LouvresBundle\Controller;

use OC\LouvresBundle\Entity\Booking;
use OC\LouvresBundle\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends Controller
{

    /**
     * @Route("/reservation",name="booking")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function bookingAction(Request $request)
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $CalPrice = $this->get('oc_louvres.price');
            $total = $CalPrice->totalPrice($booking);
            $price = $CalPrice->calPrice($booking);
            $request->getSession()->set('booking', $booking);

            return $this->redirectToRoute('recap');
        }

        return $this->render('OCLouvresBundle:Booking:booking.html.twig', array(
            'Bookingform' => $form->createView(),
        ));
    }

    /**
     * @Route("/recap", name="recap")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recapAction(Request $request)
    {

        $booking = $request->getSession()->get('booking');


        // TODO ne pas faire appel à la session dans les vues => passer directement la commande depuis controller
        return $this->render('OCLouvresBundle:Booking:recap.html.twig',
            [
                'booking' => $booking
            ]);

    }

    /**
     * @Route("/charge", name="charge")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function chargeAction(Request $request)
    {

        \Stripe\Stripe::setApiKey("sk_test_oK5aydcTxWsXLGOHPc7vztCX");

        $token = $request->request->get('stripeToken');
        $booking = $request->getSession()->get('booking');

        dump($token);

        try {
            $charge = \Stripe\Charge::create([
                'amount' => 1000,
                'currency' => 'eur',
                'description' => 'Achat de billets',
                'source' => $token,
            ]);
        } catch (\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $body = $e->getJsonBody();
            $err = $body['error'];

        }

        return $this->redirectToRoute('validation');
    }

    /**
     * @Route("/validation",name="validation")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function validationAction(Request $request)
    {

        $booking = $request->getSession()->get('booking');

        return $this->render('OCLouvresBundle:Booking:validation.html.twig');
    }

}
