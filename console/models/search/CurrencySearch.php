<?php

namespace console\models\search;

use console\models\Currency;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class CurrencySearch
 * @package console\models\search
 */
class CurrencySearch
{
    /**
     * @return array
     * @throws InvalidConfigException
     */
    public function mapCurrenciesToArrayWithNameAsKeys(): array
    {
        $currencies = Currency::find()
            ->all()
        ;
        return ArrayHelper::getColumn($currencies, 'name');
    }
}
