<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CurrencyExchangeService;

class CurrencyExchangeServiceTest extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CurrencyExchangeService(config('currencies.currencies'));
    }

    public function testInvalidSourceOrTarget()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->convert('INVALID_SOURCE', 'JPY', 1000);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->service->convert('USD', 'INVALID_TARGET', 1000);
    }

    public function testInvalidAmount()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->convert('USD', 'JPY', 'INVALID_AMOUNT');
    }

    public function testRoundingAmount()
    {
        $result = $this->service->convert('USD', 'JPY', 1000.456);
        $this->assertEquals("111,801.46", $result);

        $result = $this->service->convert('USD', 'JPY', 1000);
        $this->assertEquals("111,801.00", $result);
    }
}
