<?php

namespace console\tests\unit\services;

use Codeception\Test\Unit;
use console\services\CurrencyService;
use console\tests\UnitTester;

class CurrencyServiceTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function testSomething()
    {
        $this->make(CurrencyService::class, [
            'getRates' => function () {
                return [
                    'USD' => '1.11111',
                    'EUR' => '2.33333'
                ];
            }
        ]);

        $this->assertTrue(false);
    }
}
