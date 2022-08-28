<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-entry',
    'language' => 'ar',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'entry\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'aliases' => [
        '@bower' => dirname(dirname(__DIR__)) . '/vendor'.'/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'defaultRoute' => 'stock/index',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-entry',
        ],
        'user' => [
            'identityClass' => 'common\models\CardEntryUser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-entry', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the entry
            'name' => 'advanced-entry',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

//        'errorHandler' => [
//            'errorAction' => 'site/error',
//        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
