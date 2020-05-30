<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/config/plugins/tntsearch.yaml',
    'modified' => 1589041265,
    'data' => [
        'enabled' => true,
        'search_route' => '/search',
        'query_route' => '/s',
        'built_in_css' => true,
        'built_in_js' => true,
        'built_in_search_page' => true,
        'enable_admin_page_events' => true,
        'search_type' => 'auto',
        'fuzzy' => false,
        'phrases' => true,
        'stemmer' => 'default',
        'display_route' => true,
        'display_hits' => true,
        'display_time' => true,
        'live_uri_update' => true,
        'limit' => 20,
        'min' => 3,
        'snippet' => 300,
        'index_page_by_default' => true,
        'scheduled_index' => [
            'enabled' => true,
            'at' => '0 */3 * * *',
            'logs' => 'logs/tntsearch-index.out'
        ],
        'filter' => [
            'items' => [
                0 => 'root@.descendants'
            ]
        ],
        'powered_by' => false,
        'search_object_type' => 'Grav'
    ]
];
