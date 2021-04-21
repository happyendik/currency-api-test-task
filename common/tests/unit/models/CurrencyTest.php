<?php

namespace common\tests\unit\models;

use Codeception\Test\Unit;
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

    public function validationDataProvider()
    {
        return [
            [['name' => ' '], false],
            [['rate' => ' '], false],
            [['name' => null], false],
            [['rate' => null], false],
            [['name' => 'UNIQUE'], true],
            [['rate' => '12.1234'], true],
        ];
    }
}
