<?php

namespace App\Listeners\PaymentApprovedEvent;

use App\Events\PaymentApprovedEvent;
use App\Mail\ApprovedPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class PaymentApprovedEmailListener implements ShouldQueue
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
    public function handle(PaymentApprovedEvent $event): void
    {
        Mail::to($event->payment->user->email)->send(new ApprovedPaymentMail($event->payment));

    }
}
