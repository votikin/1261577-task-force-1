<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
//                'defaultRoute' => 'tasks/index',
                'tasks/' => 'tasks/index',
                'users/' => 'users/index',
                'signup' => 'signup/index',
                'create' => 'create/index',
                'logout' => 'users/logout',
                'tasks/view/<id:\d+>' => 'tasks/view',
                'users/view/<id:\d+>' => 'users/view',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/messages'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/tasks'],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
