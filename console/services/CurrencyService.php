<?php

namespace console\services;

use common\models\Currency;
use console\models\search\CurrencySearch;
use console\parsers\CbrRatesParser;
use Yii;

/**
 * Class CurrencyService
 * @package console\services
 */
class CurrencyService
{
    public function __construct(CbrRatesParser $ratesParser, CurrencySearch $currencySearch)
    {
        $this->ratesParser = $ratesParser;
        $this->currencySearch = $currencySearch;
    }

    public function refreshRates()
    {
        $rates = $this->ratesParser->getRates();
        $existedCurrencies = $this->currencySearch->mapCurrenciesToArrayWthNameAsKeys();

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
                $newCurrency = new Currency([
                    'name' => strtoupper($name),
                    'rate' => $rate
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
