<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mhospit1_yii2mbase',//websub
            'username' => 'mhospit1',
            'password' => '##858480=@@',
            'charset' => 'utf8',
        ],
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mhospit1_mbase',//webmain
            'username' => 'mhospit1',
            'password' => '##858480=@@',
            'charset' => 'utf8',
        ],
        'db3' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mhospit1_dhdc3',
            'username' => 'mhospit1',
            'password' => '##858480=@@',
            'charset' => 'utf8',
        ],
	  'db4' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mhospit1_yii2',
            'username' => 'mhospit1',
            'password' => '##858480=@@',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
