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
    public $rateService;

    public function __construct($id, $module, $config = [], CurrencyService $rateService)
    {
        $this->rateService = $rateService;
        parent::__construct($id, $module, $config);
    }

    public function actionRefreshRates()
    {
        $this->rateService->refreshRates();
    }
}
