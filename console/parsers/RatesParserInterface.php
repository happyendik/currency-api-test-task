<?php

namespace console\parsers;

/**
 * Interface RatesParserInterface
 * @package console\parsers
 */
interface RatesParserInterface
{
    /**
     * @return array
     */
    public function getRates(): array;
}
