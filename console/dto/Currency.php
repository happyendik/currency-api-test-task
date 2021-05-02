<?php

namespace console\dto;

/**
 * Class Currency
 * @package console\dto
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
        $this->setName($name);
        $this->setRate($rate);
    }

    public function getName(): string
    {
        return $this->_name;
    }

    public function setName(string $name): void
    {
        $this->_name = $name;
    }

    public function getRate(): string
    {
        return $this->_rate;
    }

    public function setRate(string $rate): void
    {
        $this->_rate = $rate;
    }
}
