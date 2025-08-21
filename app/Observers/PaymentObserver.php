<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Order;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        $order = Order::where('id',$payment->order_id)->first();

        if($order){
            $order->payment_reference = $payment->payment_reference;
            $order->payment_method =$payment->payment_method;
            $order->payment_status= $payment->status;
        }
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     */
    public function restored(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     */
    public function forceDeleted(Payment $payment): void
    {
        //
    }
}
