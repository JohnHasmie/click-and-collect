<?php

namespace App\Services;

use Stripe;
use Cart;

class StripeService
{
    protected $payPal;

    public function __construct()
    {
        if (config('settings.stripe_secret') == '') {
            return redirect()->back()->with('error', 'No PayPal settings found.');
        }

        Stripe\Stripe::setApiKey(config('settings.stripe_secret'));
    }

    public function processPayment($order)
    {
        Stripe\Charge::create ([
            "amount" => Cart::getTotal()*100,
            "currency" => config('settings.currency_code'),
            "source" => $order->stripeToken,
            "description" => "Test payment from click and collect." 
        ]);
    }
}