<?php

namespace console\tests\unit\services;

use Codeception\Stub;
use Codeception\Test\Unit;
use console\dto\Currency as CurrencyEntity;
use console\models\search\CurrencySearch;
use console\parsers\CbrRatesParser;
use console\services\CurrencyService;
use console\tests\UnitTester;
use yii\base\InvalidConfigException;

class CurrencyServiceTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws InvalidConfigException
     */
    public function testRateFromParserExists()
    {
        $parser = Stub::makeEmpty(CbrRatesParser::class);
        $search = Stub::make(CurrencySearch::class, [
            'mapCurrenciesToArrayWithNameAsKeys' => function () {
                return ['usd', 'eur'];
            }
        ]);

        $currencyEntity = new CurrencyEntity('usd', '1.123123');

        $currencyService = new CurrencyService($parser, $search);
        $result = $currencyService->doesRateExist($currencyEntity);
        $this->assertTrue($result);
    }

    /**
     * @throws InvalidConfigException
     */
    public function testRateFromParserDoesNotExist()
    {
        $parser = Stub::makeEmpty(CbrRatesParser::class);
        $search = Stub::make(CurrencySearch::class, [
            'mapCurrenciesToArrayWithNameAsKeys' => function () {
                return ['usd', 'eur'];
            }
        ]);

        $currencyEntity = new CurrencyEntity('aud', '1.123123');

        $currencyService = new CurrencyService($parser, $search);
        $result = $currencyService->doesRateExist($currencyEntity);
        $this->assertFalse($result);
    }
}
