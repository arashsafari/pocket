<?php

namespace App\Jobs;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SaveCurrencyRateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('save-rate');
    }

    public $tries = 3;
    public $maxExceptions = 3;
    public $timeout = 300;
    public $failOnTimeout = true;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $rateCurrency = Currency::query()->where('iso_code', 'irr')->first();
        if (!$rateCurrency) {
            throw new NotFoundHttpException();
        }

        $response = Http::get(config('settings.api.navasan.base_url'), [
            'api_key' => config('settings.api.navasan.base_key')
        ]);
        if (!$response->ok()) {
            throw new BadRequestException();
        }

        $rateList = $response->json();
        $currencies = Currency::query()->get();
        foreach ($currencies as $currency) {
            Rate::create([
                'currency_key' => $currency->key,
                'rate' => $rateList[$currency->iso_code]['value'],
                'rate_currency_key' => $rateCurrency->key,
            ]);
        }
    }
}
