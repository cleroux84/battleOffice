<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="payment")
     */
    public function index()
    {
       /*  \Stripe\Stripe::setApiKey('sk_test_51H2XPXKI1XZO9WyCwjTG82KvDP2e9dq6FiW0Y09O6CzacMWf6q5BdgvzlwPEWWtdGVbmjAkzlvtiWh7CycAMSMit00PLLf9q3B');
             
            try{
            // Token is created using Stripe Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $token = $request->request->get('stripeToken');
            
            $charge = \Stripe\PaymentIntent::create([
            'amount' =>intval( $payment->getAmount()),
            'currency' => 'eur',
            'description' => 'Example charge',
            'source' => $token,
            
            ]);
            
            } catch (\Exception $e) {
              
            } */


        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }
}
