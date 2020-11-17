<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Balance;
use Stripe\PaymentIntent;
use Stripe\Payout;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Transfer;

class CheckoutController extends Controller
{
    public function checkout()
    {
        // Enter Your Stripe Secret
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $amount = 23.60;

        $payment_intent = PaymentIntent::create([
            'payment_method_types' => ['card'],
            'amount' => $amount *100,
            'currency' => 'gbp',
            'application_fee_amount' => 300*100,
            'capture_method' => 'manual',
//            'confirmation_method' => 'manual',
//            'requires_action' => 'true',
        ], ['stripe_account' => 'acct_1HcGOHJQOtlbRTN5']);

//        $payment_intent = PaymentIntent::create([
//            'payment_method_types' => ['card'],
//            'amount' => 1000,
//            'currency' => 'gbp',
//            'transfer_data' => [
//                'destination' => 'acct_1HcGOHJQOtlbRTN5',
//            ],
//        ]);

//        $refund = Refund::create([
//            'charge' => '{CHARGE_ID}',
//            'reverse_transfer' => true,
//        ]);

        $payment_id = $payment_intent->id;

        $intent = $payment_intent->client_secret;

//        $stripe = new StripeClient(
//            env('STRIPE_SECRET_KEY')
//        );
//
//        $stripe->paymentIntents->capture(
//            $intent,
//            []
//        );
        return view('welcome',compact('intent','payment_id'));

    }

    public function afterPayment(Request $request)
    {

//        dd($request->payment_id);




        echo 'OK';
    }
}
