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
    public $currencyService;

    public function __construct($id, $module, $config = [], CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
        parent::__construct($id, $module, $config);
    }

    public function actionRefreshRates()
    {
        $this->currencyService->refreshRates();
    }
}
