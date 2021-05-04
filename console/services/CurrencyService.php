<?php

namespace console\services;

use console\models\search\CurrencySearch;
use console\parsers\CbrRatesParser;
use console\parsers\RatesParserInterface;
use console\repositories\CurrencyRepository;

/**
 * Class CurrencyService
 * @package console\services
 */
class CurrencyService
{
    /**
     * @var CurrencyRepository
     */
    private $_currencyRepository;

    /**
     * @var RatesParserInterface
     */
    private $_ratesParser;

    /**
     * CurrencyService constructor.
     * @param CbrRatesParser $ratesParser
     * @param CurrencySearch $currencySearch
     */
    public function __construct(CurrencyRepository $currencyRepository, CbrRatesParser $ratesParser)
    {
        $this->_currencyRepository = $currencyRepository;
        $this->_ratesParser = $ratesParser;
    }

    public function refreshRates(): void
    {
        foreach ($this->_ratesParser->getRates() as $rate) {
            $this->_currencyRepository->persist($rate);
        }
    }
}
