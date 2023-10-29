<?php

namespace App\Console\Commands;

use App\Jobs\DeleteListOfPaymentJob;
use App\Models\Payment;
use Illuminate\Console\Command;

class DeleteListOfPaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:delete-list {status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete list of payment with status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Payment::where('status', $this->argument('status'))->chunk(config('settings.payment.delete_list_of_payment_number'), function ($payments) {
            DeleteListOfPaymentJob::dispatch($payments->pluck('id')->toArray());
        });
    }
}
