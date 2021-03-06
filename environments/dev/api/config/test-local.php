<?php

use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require __DIR__ . '/../../common/config/codeception-local.php',
    require __DIR__ . '/main.php',
    require __DIR__ . '/main-local.php',
    require __DIR__ . '/test.php',
    [
        'homeUrl' => '/',
        'components' => [
            'assetManager' => [
                'basePath' => '@api/tests/_output',
            ],
            'request' => [
                'baseUrl' => '',
            ],
        ],
    ]
);
