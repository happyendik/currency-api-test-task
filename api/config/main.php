<?php

return [
    'id' => 'currency-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'GET v1/currencies' => 'v1/currency/index',
                'GET v1/currency/<name:[\S]+>' => 'v1/currency/view',
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => \common\models\User::class,
            'enableSession' => false,
        ],
    ],
    'modules' => [
        'v1' => api\modules\v1\Module::class,
    ],
];
