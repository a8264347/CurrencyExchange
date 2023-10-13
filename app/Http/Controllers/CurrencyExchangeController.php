<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyExchangeRequest;
use App\Services\CurrencyExchangeService;

class CurrencyExchangeController extends Controller
{
    protected $service;

    public function __construct(CurrencyExchangeService $service)
    {
        $this->service = $service;
    }

    public function convert(CurrencyExchangeRequest $request)
    {
        try {
            $amount = $this->service->convert(
                $request->input('source'),
                $request->input('target'),
                $request->input('amount')
            );
            return response()->json(['msg' => 'success', 'amount' => $amount]);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 400);
        }
    }
}
