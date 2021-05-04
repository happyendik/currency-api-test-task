<?php

namespace console\entities;

/**
 * Class Currency
 * @package console\entities
 */
class Currency
{
    /**
     * @var string
     */
    private $_name;

    /**
     * @var string
     */
    private $_rate;

    public function __construct(string $name, string $rate)
    {
        $this->_name = $name;
        $this->_rate = $rate;
    }

    public function name(): string
    {
        return $this->_name;
    }

    public function rate(): string
    {
        return $this->_rate;
    }
}
