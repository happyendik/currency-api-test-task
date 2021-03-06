<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\Currency;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Class CurrencyController
 * @package api\modules\v1\controllers
 */
class CurrencyController extends Controller
{
    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ],
            ],
        ];
    }

    /**
     * @return object|ActiveDataProvider
     * @throws InvalidConfigException
     */
    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Currency::find()
        ]);
    }

    /**
     * @param string $name
     * @return array|Currency|null
     * @throws InvalidConfigException
     */
    public function actionView(string $name)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $currency = Currency::find()
            ->select(['rate'])
            ->byName($name)
            ->asArray()
            ->one()
        ;
        return $currency;
    }
}
