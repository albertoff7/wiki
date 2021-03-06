<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/plugins/recaptchacontact/blueprints/default.yaml',
    'modified' => 1589538215,
    'data' => [
        'title' => 'Contact Form',
        'description' => 'These are page specific settings. Adjust site-wide changes on the [plugin page](http://grav.test/admin/plugins/recaptchacontact)',
        '@extends' => [
            'type' => 'default',
            'context' => 'blueprints://pages'
        ],
        'form' => [
            'fields' => [
                'tabs' => [
                    'type' => 'tabs',
                    'active' => 1,
                    'fields' => [
                        'contact' => [
                            'type' => 'tab',
                            'title' => 'RECAPTCHACONTACT.ADMIN.HEADING',
                            'fields' => [
                                'header.recaptchacontact.enabled' => [
                                    'type' => 'select',
                                    'size' => 'short',
                                    'classes' => 'fancy',
                                    'label' => 'RECAPTCHACONTACT.ADMIN.HEADING',
                                    'help' => 'RECAPTCHACONTACT.ADMIN.TOGGLE.HELP',
                                    'options' => [
                                        '' => 'PLUGIN_ADMIN.DISABLED',
                                        1 => 'PLUGIN_ADMIN.ENABLED'
                                    ],
                                    'validate' => [
                                        'type' => 'bool'
                                    ]
                                ],
                                'header.recaptchacontact.recipient' => [
                                    'type' => 'text',
                                    'label' => 'RECAPTCHACONTACT.ADMIN.RECIPIENT.LABEL',
                                    'help' => 'RECAPTCHACONTACT.ADMIN.RECIPIENT.HELP'
                                ],
                                'header.recaptchacontact.subject' => [
                                    'type' => 'text',
                                    'label' => 'RECAPTCHACONTACT.ADMIN.SUBJECT.LABEL',
                                    'help' => 'RECAPTCHACONTACT.ADMIN.SUBJECT.HELP'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
