<?php

namespace console\parsers;

use console\entities\Currency;
use DOMDocument;
use DOMElement;
use Generator;

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
        $result = [];
        foreach ($this->getDataFromCbr() as $data) {
            $result[] = new Currency($data['charCode'], $data['rate']);
        }

        return $result;
    }

    /**
     * @return Generator
     */
    private function getDataFromCbr()
    {
        $xml = new DOMDocument();

        $xml->load($this->url);
        $root = $xml->documentElement;
        $items = $root->getElementsByTagName('Valute');

        /** @var DOMElement $item */
        foreach ($items as $item) {
            $charCode = $item->getElementsByTagName('CharCode')->item(0)->textContent;
            $nominal = str_replace(',', '.', $item->getElementsByTagName('Nominal')->item(0)->textContent);
            $value = str_replace(',', '.', $item->getElementsByTagName('Value')->item(0)->textContent);

            yield [
                'charCode' => strtolower($charCode),
                'rate' => $this->calculateRate($value, $nominal)
            ];
        }
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
