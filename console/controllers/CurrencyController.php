<?php

namespace console\controllers;

use console\services\CurrencyService;
use yii\console\Controller;

/**
 * Class CurrencyController
 * @package console\controllers
 */
class CurrencyController extends Controller
{
    /**
     * @var CurrencyService
     */
    private $_currencyService;

    /**
     * CurrencyController constructor.
     * {@inheritDoc}
     * @param CurrencyService $currencyService
     */
    public function __construct($id, $module, $config = [], CurrencyService $currencyService)
    {
        $this->_currencyService = $currencyService;
        parent::__construct($id, $module, $config);
    }

    public function actionRefreshRates(): void
    {
        $this->_currencyService->refreshRates();
    }
}
