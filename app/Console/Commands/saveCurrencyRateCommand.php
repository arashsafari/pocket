<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class saveCurrencyRateCommand extends Command
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
        $response = Http::get('http://api.navasan.tech/latest/?api_key=' . env('NAVASAN_KEY'));
        $rateList = $response->json();

        $rateCurrency = Currency::query()->where('iso_code', 'irr')->first();
        
        $currencies = Currency::query()->get();
        foreach ($currencies as $currency) {
            Rate::create([
                'currency_key' => $currency->key,
                'rate' => $rateList[$currency->iso_code]['value'] ,
                'rate_currency_key' => $rateCurrency->key,
            ]);
        }
    }
}
