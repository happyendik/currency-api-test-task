<?php

namespace console\parsers;

use console\entities\Currency;

/**
 * Interface RatesParserInterface
 * @package console\parsers
 */
interface RatesParserInterface
{
    /**
     * @return Currency[]
     */
    public function getRates(): array;
}
