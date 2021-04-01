<?php

namespace console\controllers;

use common\models\Currency;
use console\models\search\CurrencySearch;
use yii\console\Controller;
use console\parsers\CbrRatesParser;
use Yii;
use yii\base\InvalidConfigException;

/**
 * Class CurrencyController
 * @package console\controllers
 */
class CurrencyController extends Controller
{
    /**
     * @throws InvalidConfigException
     */
    public function actionRefreshRates()
    {
        /** @var CbrRatesParser $ratesParser */
        $ratesParser = Yii::createObject(CbrRatesParser::class);
        $rates = $ratesParser->getRates();

        $currencySearch = Yii::createObject(CurrencySearch::class);
        $existedCurrencies = $currencySearch->mapCurrenciesToArrayWthNameAsKeys();

        foreach ($rates as $name => $rate) {
            if (array_key_exists($name, $existedCurrencies)) {
                /** @var Currency $currency */
                $currency = $existedCurrencies[$name];
                if (!$currency->save()) {
                    Yii::error([
                        'errors' => $currency->getErrors()
                    ]);
                }
            } else {
                /** @var Currency $newCurrency */
                $newCurrency = Yii::createObject(Currency::class, [
                    [
                        'name' => strtoupper($name),
                        'rate' => $rate
                    ]
                ]);
                if (!$newCurrency->save()) {
                    Yii::error([
                        'errors' => $newCurrency->getErrors()
                    ]);
                }
            }
        }
    }
}
