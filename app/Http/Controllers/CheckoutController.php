<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Services\PaypalService;
use App\Services\StripeService;
use Cart;
use App\Models\Order;

class CheckoutController extends Controller
{
    protected $orderRepository;

    protected $payPal;

    protected $stripe;

    public function __construct(OrderContract $orderRepository, PaypalService $payPal, StripeService $stripe)
    {
        $this->payPal = $payPal;
        $this->stripe = $stripe;
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        return view('checkout');
    }

    public function placeOrder(Request $request)
    {
        // Before storing the order we should implement the
        // request validation which I leave it to you
        $order = $this->orderRepository->storeOrderDetails($request->all());

        // You can add more control here to handle if the order
        // is not stored properly
        $stripeToken = $request->input('stripeToken');
        if ($order) {
            if (!$stripeToken) {
                $this->payPal->processPayment($order);
            } else {
                $order->status = 'completed';
                $order->payment_status = 1;
                $order->payment_method = 'Stripe -'.$request->input('stripeEmail');
                $order->save();

                $order->stripeToken = $stripeToken;
                $this->stripe->processPayment($order);

                Cart::clear();
                return view('success', compact('order'));
            }
        }

        return redirect()->back()->with('message','Order not placed');
    }

    public function complete(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        Cart::clear();
        return view('success', compact('order'));
    }
}
