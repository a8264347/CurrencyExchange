<?php

namespace App\Services;

class CurrencyExchangeService
{
    protected $rates;

    public function __construct(array $rates)
    {
        $this->rates = $rates;
    }

    public function convert($source, $target, $amount)
    {
        if (!isset($this->rates[$source]) || !isset($this->rates[$target])) {
            throw new \Exception("Currency not supported");
        }

        $amount = str_replace(',', '', $amount);
        $convertedAmount = $amount * ($this->rates[$source][$target] ?? 1);

        return number_format(round($convertedAmount, 2), 2);
    }
}
