<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv("DB_DSN"),
            'username' => getenv("DB_USERNAME"),
            'password' => getenv("DB_PASSWORD"),
            'charset' => getenv("DB_CHARSET"),
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => getenv('MAIL_USE_FILE_TRANSPORT'),
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => getenv('MAIL_SMTP_HOST'),
                'username' => getenv('MAIL_SMTP_USERNAME'),
                'password' => getenv('MAIL_SMTP_PASSWORD'),
                'port' => getenv('MAIL_SMTP_PORT'),
                'encryption' => getenv('MAIL_SMTP_ENCRYPTION'),
            ],
        ],
    ],
];
