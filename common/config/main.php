<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport'=>[
                'class' => 'Swift_SmtpTransport',
                'host' => 'email-smtp.us-east-1.amazonaws.com',// amazon smtp host
                'username' => 'AKIAQP5CTUKTKTEX5JWH',// ses user username
                'password' => 'BBX8MYevkRgsR20i3b2aF4p3HgcfH1MSWjiXiinZNOdW',// ses user password
                'port' => '587',
                'encryption' => 'tls',
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

    ],

];
