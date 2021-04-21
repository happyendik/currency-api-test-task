<?php

return [
    'id' => 'currency-api-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'assetManager' => [
            'basePath' => '@api/tests/_output',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];

