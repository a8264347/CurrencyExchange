<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CurrencyExchangeService;

class CurrencyExchangeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CurrencyExchangeService::class, function ($app) {
            $rates = config('currencies.currencies');
            return new CurrencyExchangeService($rates);
        });
    }
}