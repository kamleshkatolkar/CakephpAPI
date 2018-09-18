<?php
use \Cake\Core\Plugin;

return [
    'CrudView' => [
        'siteTitle' => 'Crud View',
        'css' => [
            'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.2/css/selectize.bootstrap3.min.css',
            'CrudView.local',
        ],
        'js' => [
            'headjs' => [
                'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.2/js/standalone/selectize.min.js',
                'https://cdn.jsdelivr.net/jquery.dirtyforms/1.2.2/jquery.dirtyforms.min.js',
                'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js',
                'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js'
            ],
            'script' => [
                'CrudView.local','CrudView.custom'
            ],
        ],
        'timezoneAwareDateTimeWidget' => false,
        'useAssetCompress' => Plugin::loaded('AssetCompress'),
        'tablesBlacklist' => [
            'phinxlog',
        ],
    ]
];
