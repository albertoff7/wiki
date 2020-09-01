<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/config/plugins/ganalytics.yaml',
    'modified' => 1591769951,
    'data' => [
        'enabled' => true,
        'trackingId' => 'UA-169029415-1',
        'position' => 'head',
        'objectName' => 'ga',
        'forceSsl' => true,
        'async' => false,
        'anonymizeIp' => true,
        'blockedIps' => NULL,
        'blockedIpRanges' => [
            0 => 'private',
            1 => 'loopback',
            2 => 'link-local'
        ],
        'blockingCookie' => 'blockGA',
        'cookieConfig' => false,
        'cookieName' => '_ga',
        'cookieDomain' => NULL,
        'cookieExpires' => 63072000,
        'optOutEnabled' => false,
        'optOutMessage' => NULL,
        'debugStatus' => false,
        'debugTrace' => false
    ]
];
