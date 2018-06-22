<?php

define('MAILCATCHER_URL', 'http://localhost:1080');

error_reporting(-1);
define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);
$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

require dirname(__FILE__) . '/../vendor/autoload.php';
require dirname(__FILE__) . '/../vendor/yiisoft/yii2/Yii.php';

$application = new \yii\console\Application([
    'id' => 'Yii2 Mail Object Test',
    'basePath' => dirname(__FILE__),
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'localhost',
                'port' => '1025',
            ],
        ],
    ]
]);
