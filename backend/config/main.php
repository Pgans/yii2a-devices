<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
      'study' => [
           'class' => 'backend\modules\study\Module',
       ],
       'equipments' => [
            'class' => 'backend\modules\equipments\Module',
        ],
        'personal' => [
            'class' => 'backend\modules\personal\Module',
        ],
        'opdcard' => [
            'class' => 'backend\modules\opdcard\Module',
        ],
        'users' => [
            'class' => 'backend\modules\users\Module',
        ], 
        'history' => [
            'class' => 'backend\modules\history\Module',
        ], 
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 1200,
           'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@backend/themes/boonlte/views'
             ],
         ],
    ],
    ],
    'params' => $params,
];
