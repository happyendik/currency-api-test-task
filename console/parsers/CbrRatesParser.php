<?php

namespace console\parsers;

use DOMDocument;
use DOMElement;

/**
 * Class CbrRatesParser
 * @package console\parsers
 */
class CbrRatesParser implements RatesParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function getRates(): array
    {
        $xml = new DOMDocument();
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp';

        $xml->load($url);
        $root = $xml->documentElement;
        $items = $root->getElementsByTagName('Valute');

        $result = [];
        /** @var DOMElement $item */
        foreach ($items as $item) {
            $charCode = $item->getElementsByTagName('CharCode')->item(0)->textContent;
            $nominal = str_replace(',', '.', $item->getElementsByTagName('Nominal')->item(0)->textContent);
            $value = str_replace(',', '.', $item->getElementsByTagName('Value')->item(0)->textContent);

            $result[] = ['name' => strtolower($charCode), 'rate' => $this->calculateRate($value, $nominal)];
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
