<?php

namespace App\Listeners\PaymentRejectedEvent;

use App\Events\PaymentRejectedEvent;
use App\Jobs\RejectPaymentJob;
use App\Mail\RejectPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PaymentRejectedEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentRejectedEvent $event): void
    {
        Mail::to($event->payment->user->email)->send(new RejectPaymentMail($event->payment));
    }
}
