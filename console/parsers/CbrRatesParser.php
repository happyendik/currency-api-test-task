<?php

namespace console\parsers;

use console\dto\Currency as CurrencyEntity;
use DOMDocument;
use DOMElement;

/**
 * Class CbrRatesParser
 * @package console\parsers
 */
class CbrRatesParser implements RatesParserInterface
{
    /**
     * @var string
     */
    protected $url = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * {@inheritDoc}
     */
    public function getRates(): array
    {
        $xml = new DOMDocument();

        $xml->load($this->url);
        $root = $xml->documentElement;
        $items = $root->getElementsByTagName('Valute');

        $result = [];
        /** @var DOMElement $item */
        foreach ($items as $item) {
            $charCode = $item->getElementsByTagName('CharCode')->item(0)->textContent;
            $nominal = str_replace(',', '.', $item->getElementsByTagName('Nominal')->item(0)->textContent);
            $value = str_replace(',', '.', $item->getElementsByTagName('Value')->item(0)->textContent);

            $result[] = new CurrencyEntity(
                strtolower($charCode),
                $this->calculateRate($value, $nominal)
            );
        }

        return $result;
    }

    /**
     * @param string $value
     * @param string $nominal
     * @return string
     */
    private function calculateRate(string $value, string $nominal): string
    {
        if ($nominal !== '1') {
            return bcdiv($value, $nominal, '10');
        }
        return $value;
    }
}
