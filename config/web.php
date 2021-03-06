<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id'           => 'basic',
    'basePath'     => dirname(__DIR__),
    'bootstrap'    => ['log'],
    'defaultRoute' => 'databases/index',
    'components'   => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'AqFaTsXr0nxZZVCyNWSo6vSc84lHGdQd',
            'parsers'             => [
                'application/json' => 'yii\web\JsonParser'
            ]
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'class'           => 'app\components\User',
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => [
            'class' => 'app\db\Connection'
        ],
        'urlManager'   => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'suffix'              => '/',
            'enableStrictParsing' => true,
            'normalizer'          => [
                'class' => 'yii\web\UrlNormalizer'
            ],
            'rules'               => [
                'GET,POST site/login/'                              => 'site/login',
                'POST site/logout/'                                 => 'site/logout',
                'GET /'                                             => 'databases/index',
                'GET databases/'                                    => 'databases/index',
                'GET databases/<db:\w+>/'                           => 'databases/show',
                'GET databases/<db:\w+>/tables/'                    => 'tables/index',
                'GET databases/<db:\w+>/tables/<table:\w+>/data/'   => 'data/index',
                'PATCH databases/<db:\w+>/tables/<table:\w+>/data/' => 'data/update',
                [
                    'pattern'  => 'query/<db:\w+>/',
                    'route'    => 'query/index',
                    'defaults' => ['db' => ''],
                    'verb'     => 'GET'
                ],
                [
                    'pattern'  => 'query/<db:\w+>/',
                    'route'    => 'query/execute',
                    'defaults' => ['db' => ''],
                    'verb'     => 'POST'
                ],
            ],
        ],

    ],
    'params'       => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

}

return $config;
