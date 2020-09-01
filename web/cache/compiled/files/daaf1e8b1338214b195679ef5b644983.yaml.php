<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/plugins/ganalytics/ganalytics.yaml',
    'modified' => 1591769545,
    'data' => [
        'enabled' => true,
        'trackingId' => '',
        'position' => 'head',
        'objectName' => 'ga',
        'forceSsl' => true,
        'async' => false,
        'anonymizeIp' => true,
        'blockedIps' => [
            
        ],
        'blockedIpRanges' => [
            0 => 'private',
            1 => 'loopback',
            2 => 'link-local'
        ],
        'blockingCookie' => 'blockGA',
        'cookieConfig' => false,
        'cookieName' => '_ga',
        'cookieDomain' => '',
        'cookieExpires' => 63072000,
        'optOutEnabled' => false,
        'optOutMessage' => '',
        'debugStatus' => false,
        'debugTrace' => false
    ]
];
