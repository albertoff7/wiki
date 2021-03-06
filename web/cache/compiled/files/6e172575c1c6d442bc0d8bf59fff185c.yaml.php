<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/plugins/filesource/blueprints.yaml',
    'modified' => 1589285482,
    'data' => [
        'name' => 'filesource',
        'version' => 0.2,
        'description' => 'With **filesource** a user can show the source of any text file in a post',
        'icon' => 'trello',
        'author' => [
            'name' => 'anza',
            'email' => 'antti@may.fi',
            'url' => 'http://notes.may.fi'
        ],
        'homepage' => 'https://github.com/anza/grav-plugin-filesource',
        'keywords' => 'text file, source, embed',
        'bugs' => 'https://github.com/anza/grav-plugin-filesource/issues',
        'license' => 'BSD',
        'form' => [
            'validation' => 'strict',
            'fields' => [
                'enabled' => [
                    'type' => 'toggle',
                    'label' => 'Plugin status',
                    'highlight' => 1,
                    'default' => 0,
                    'options' => [
                        1 => 'Enabled',
                        0 => 'Disabled'
                    ],
                    'validate' => [
                        'type' => 'bool'
                    ]
                ]
            ]
        ]
    ]
];
