<?php

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use common\fixtures\CurrencyFixture;
use common\models\Currency;
use common\tests\UnitTester;

/**
 * Class CurrencyTest
 * @package common\tests\unit\models
 */
class CurrencyTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @return string[]
     */
    public function _fixtures()
    {
        return [
            CurrencyFixture::class,
        ];
    }

    /**
     * @param array $attribute
     * @param bool $expected
     * @dataProvider validationDataProvider
     */
    public function testValidation(array $attribute, bool $expected)
    {
        $model = new Currency();
        $model->load($attribute, '');
        $this->assertEquals($expected, $model->validate(array_keys($attribute)), json_encode($attribute));
    }

    /**
     * @return array[]
     */
    public function validationDataProvider()
    {
        return [
            [['name' => ' '], false],
            [['rate' => ' '], false],
            [['name' => null], false],
            [['rate' => null], false],
            [['name' => 'UNIQUE'], true],
            [['name' => 'usd'], false], //  есть в фикстурах
            [['rate' => '12.1234'], true],
            [['rate' => '0.000000'], true],
        ];
    }
}
