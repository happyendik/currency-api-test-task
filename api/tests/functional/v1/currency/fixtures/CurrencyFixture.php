<?php

namespace api\tests\functional\v1\currency\fixtures;

use common\models\Currency;
use yii\test\ActiveFixture;

class CurrencyFixture extends ActiveFixture
{
    public $modelClass = Currency::class;
}
