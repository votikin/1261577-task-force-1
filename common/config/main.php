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
//                'defaultRoute' => 'index',
                'tasks/' => 'tasks/index',
                'users/' => 'users/index',
                'signup' => 'signup/index',
                'tasks/view/<id:\d+>' => 'tasks/view',
                'users/view/<id:\d+>' => 'users/view',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
