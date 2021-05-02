<?php

namespace common\fixtures;

use common\models\Currency;
use yii\test\ActiveFixture;

/**
 * Class CurrencyFixture
 * @package common\fixtures
 */
class CurrencyFixture extends ActiveFixture
{
    /**
     * @var string
     */
    public $modelClass = Currency::class;
}
