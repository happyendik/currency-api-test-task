<?php

namespace console\services;

use common\models\Currency;
use console\models\search\CurrencySearch;
use console\parsers\CbrRatesParser;
use yii\base\InvalidConfigException;

/**
 * Class CurrencyService
 * @package console\services
 */
class CurrencyService
{
    /**
     * @var array
     */
    private $_dbRates;

    /**
     * CurrencyService constructor.
     * @param CbrRatesParser $ratesParser
     * @param CurrencySearch $currencySearch
     */
    public function __construct(CbrRatesParser $ratesParser, CurrencySearch $currencySearch)
    {
        $this->ratesParser = $ratesParser;
        $this->currencySearch = $currencySearch;
    }

    /**
     * Refresh rates console command for CRON
     */
    public function refreshRates()
    {
        foreach ($this->ratesParser->getRates() as $rate) {
            if ($this->doesRateExist($rate)) {
                $this->updateExistedRate($rate);
            } else {
                $this->addNewRate($rate);
            }
        }
    }

    /**
     * @param array $rate
     * @return bool
     * @throws InvalidConfigException
     */
    public function doesRateExist(array $rate): bool
    {
        if (!isset($this->_dbRates)) {
            $this->_dbRates = $this->currencySearch->mapCurrenciesToArrayWthNameAsKeys();
        }

        return array_key_exists($rate['name'], $this->_dbRates);
    }

    /**
     * @param array $rate
     * @return bool
     */
    public function addNewRate(array $rate): bool
    {
        $newCurrency = new Currency([
            'name' => $rate['name'],
            'rate' => $rate['rate'],
        ]);

        return $newCurrency->save();
    }

    /**
     * @param array $rate
     * @return bool
     * @throws InvalidConfigException
     */
    public function updateExistedRate(array $rate): bool
    {
        $currency = Currency::find()
            ->andWhere(['name' => $rate['name']])
            ->one();

        $currency->rate = $rate['rate'];
        return $currency->save();
    }
}
