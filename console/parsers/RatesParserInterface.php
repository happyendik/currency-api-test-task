<?php

namespace console\parsers;

use console\dto\Currency as CurrencyEntity;

/**
 * Interface RatesParserInterface
 * @package console\parsers
 */
interface RatesParserInterface
{
    /**
     * @return CurrencyEntity[]
     */
    public function getRates(): array;
}
