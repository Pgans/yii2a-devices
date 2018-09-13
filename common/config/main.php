<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name'=> 'รพ.ม่วงสามสิบ',
    'language' => 'th_TH',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
      'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ]
],
];
