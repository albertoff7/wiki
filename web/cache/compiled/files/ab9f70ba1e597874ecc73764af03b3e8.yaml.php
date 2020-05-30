<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledYamlFile',
    'filename' => '/var/www/html/user/config/plugins/file-browser.yaml',
    'modified' => 1589554227,
    'data' => [
        'enabled' => true,
        'built_in_css' => true,
        'load_font_awesome' => true,
        'fa4_compatability' => true,
        'source' => 'user://files',
        'show_hidden_files' => false,
        'default_view' => 'tile',
        'base_to_extend' => 'partials/base.html.twig',
        'use_alt_arrows' => false,
        'icon_weight' => 'fas',
        'sort_show' => true,
        'sort_reverse' => false,
        'file_icon_default' => 'fa-file-alt',
        'show_thumbnails' => true,
        'thumbnail_types' => 'png, jpg, jpeg, gif, bmp, svg',
        'file_icons_specific' => true,
        'colourise_icons' => true,
        'file_icon_types' => [
            'fa-file-word' => 'doc, docx, odt, rtf',
            'fa-file-csv' => 'csv',
            'fa-file-excel' => 'xls, xlsx, ods',
            'fa-file-powerpoint' => 'ppt, pps, pptx, ppsx, odp',
            'fa-file-archive' => 'zip',
            'fa-file-video' => 'mp4, mov',
            'fa-file-audio' => 'mp3, ogg, wav',
            'fa-file-image' => 'png, jpg, jpeg, gif, bmp, svg',
            'fa-file-pdf' => 'pdf'
        ],
        'sort_icon_asc' => NULL,
        'sort_icon_desc' => NULL
    ]
];