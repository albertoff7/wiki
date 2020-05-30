<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/config/plugins/email.yaml',
    'modified' => 1589552625,
    'data' => [
        'enabled' => true,
        'from' => 'alberto@comunidadlinux.es',
        'from_name' => 'Alberto',
        'to' => 'albertof417@gmail.com',
        'to_name' => 'Alberto',
        'queue' => [
            'enabled' => false,
            'flush_frequency' => '* * * * *',
            'flush_msg_limit' => 10,
            'flush_time_limit' => 100
        ],
        'mailer' => [
            'engine' => 'sendmail',
            'smtp' => [
                'server' => 'email-smtp.eu-west-2.amazonaws.com',
                'port' => 465,
                'encryption' => 'tls',
                'user' => 'AKIAQ3OQKRZZ6M573NBX',
                'password' => NULL
            ],
            'sendmail' => [
                'bin' => '/usr/sbin/sendmail -bs'
            ]
        ],
        'content_type' => 'text/html',
        'debug' => true,
        'charset' => NULL,
        'cc' => NULL,
        'cc_name' => NULL,
        'bcc' => NULL,
        'reply_to' => NULL,
        'reply_to_name' => NULL,
        'body' => NULL
    ]
];
