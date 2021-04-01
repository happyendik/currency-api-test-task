<?php

namespace console\models\search;

use console\models\Currency;
use yii\helpers\ArrayHelper;

class CurrencySearch extends Currency
{
    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function mapCurrenciesToArrayWthNameAsKeys()
    {
        $currencies = Currency::find()
            ->all()
        ;

        return ArrayHelper::map($currencies, 'name', function ($model) {
            return $model; //TODO: Можно сделать красивее?
        });

    }
}
