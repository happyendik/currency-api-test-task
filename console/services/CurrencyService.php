<?php

namespace console\services;

use common\models\Currency;
use console\dto\Currency as CurrencyDto;
use console\models\search\CurrencySearch;
use console\parsers\CbrRatesParser;
use console\parsers\RatesParserInterface;
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
     * @var RatesParserInterface
     */
    private $_ratesParser;

    /**
     * @var CurrencySearch
     */
    private $_currencySearch;

    /**
     * CurrencyService constructor.
     * @param CbrRatesParser $ratesParser
     * @param CurrencySearch $currencySearch
     */
    public function __construct(CbrRatesParser $ratesParser, CurrencySearch $currencySearch)
    {
        $this->_ratesParser = $ratesParser;
        $this->_currencySearch = $currencySearch;
    }

    /**
     * @throws InvalidConfigException
     */
    public function refreshRates(): void
    {
        foreach ($this->_ratesParser->getRates() as $rate) {
            if ($this->doesRateExist($rate)) {
                $this->updateExistedRate($rate);
            } else {
                $this->addNewRate($rate);
            }
        }
    }

    /**
     * @param CurrencyDto $rate
     * @return bool
     * @throws InvalidConfigException
     */
    public function doesRateExist(CurrencyDto $rate): bool
    {
        if (!isset($this->_dbRates)) {
            $this->_dbRates = $this->_currencySearch->mapCurrenciesToArrayWithNameAsKeys();
        }

        return in_array($rate->getName(), $this->_dbRates);
    }

    /**
     * @param CurrencyDto $rate
     * @return bool
     */
    public function addNewRate(CurrencyDto $rate): bool
    {
        $newCurrency = new Currency([
            'name' => $rate->getName(),
            'rate' => $rate->getRate(),
        ]);

        return $newCurrency->save();
    }

    /**
     * @param CurrencyDto $rate
     * @return bool
     * @throws InvalidConfigException
     */
    public function updateExistedRate(CurrencyDto $rate): bool
    {
        $currency = Currency::find()
            ->byName($rate->getName())
            ->one()
        ;
        $currency->rate = $rate->getRate();
        return $currency->save();
    }
}
