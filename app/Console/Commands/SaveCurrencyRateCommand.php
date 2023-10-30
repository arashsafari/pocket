<?php

namespace App\Console\Commands;

use App\Jobs\SaveCurrencyRateJob;
use Illuminate\Console\Command;

class SaveCurrencyRateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:save-currency-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'save rate for currency';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SaveCurrencyRateJob::dispatch();
    }
}
