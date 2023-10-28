<?php

namespace App\Listeners\ApprovedPaymentEvent;

use App\Events\ApprovedPaymentEvent;
use App\Mail\ApprovedPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class ApprovedPaymentEmailListener implements ShouldQueue
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
    public function handle(ApprovedPaymentEvent $event): void
    {
        Mail::to($event->payment->user->email)->send(new ApprovedPaymentMail($event->payment));

    }
}
