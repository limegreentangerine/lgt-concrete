<?php

return [
    'updates' => [
        // Skip the automatic check of new Concrete versions availability
        'skip_core' => true,
    ],
    'debug' => [
        'hide_keys' => [
            // Hide database password and hostname in whoops output if supported
            '_ENV' => ['DB_PASSWORD', 'DB_HOSTNAME'],
            '_SERVER' => ['DB_PASSWORD', 'DB_HOSTNAME'],
        ]
    ],
    'security' => [
        'production' => [
            'staging' => [
                'show_notification_to_unregistered_users' => true,
            ],
        ],
        'session' => [
            'invalidate_on_ip_mismatch' => true,
        ],
    ],
    'seo' => [
        'redirect_to_canonical_url' => true,
        'url_rewriting' => true,
        'url_rewriting_all' => true,
        'trailing_slash' => true,
        'title_format' => '%1$s | %2$s',
        'title_segment_separator' => ' | ',
    ],
    'accessibility' => [
        'toolbar_titles' => true,
        'toolbar_tooltips' => true,
        'toolbar_large_font' => false,
    ],
    'white_label' => [
        'name' => 'limegreentangerine',
        'logo' => false,
        'background_image' => 'none',
    ],
    'session' => [
        'name' => 'LGTCMSSESSION',
        'handler' => 'database',
        'cookie' => [
            'cookie_secure' => true,
        ],
    ],
    'marketplace' => [
        'enabled' => false,
    ],
    'external' => [
        'intelligent_search_help' => true,
        'news_overlay' => false,
        'news' => false,
    ],
    'design' => [
        'enable_custom' => false,
        'enable_layouts' => false,
    ],
];
