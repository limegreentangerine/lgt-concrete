<?php

return [
    'updates' => [
        'skip_core' => true,
    ],
    'debug' => [
        'hide_keys' => [
            '_ENV' => [
                'DB_PASSWORD',
                'DB_HOSTNAME',
            ],
            '_SERVER' => [
                'DB_PASSWORD',
                'DB_HOSTNAME',
            ],
        ],
    ],
    'security' => [
        'production' => [
            'staging' => [
                'show_notification_to_unregistered_users' => true,
            ],
        ],
        'session' => [
            'invalidate_on_ip_mismatch' => false,
        ],
    ],
    'seo' => [
        'redirect_to_canonical_url' => false,
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
    'version_installed' => '9.5.7',
    'version_db_installed' => '20261020120000',
    'misc' => [
        'login_redirect' => 'HOMEPAGE',
        'access_entity_updated' => 1793722119,
    ],
    'email' => [
        'default' => [
            'address' => 'devrow@limegreentangerine.co.uk',
        ],
    ],
    'social' => [
        'additional_services' => [
            [
                'facebook',
                'Facebook',
                'fab fa-facebook',
                '<i class="bi bi-facebook"></i>',
            ],
            [
                'twitter',
                'Twitter/X',
                'fab fa-twitter',
                '<i class="bi bi-twitter-x"></i>',
            ],
            [
                'instagram',
                'Instagram',
                'fab fa-instagram',
                '<i class="bi bi-instagram"></i>',
            ],
            [
                'github',
                'Github',
                'fab fa-github-square',
                '<i class="bi bi-github"></i>',
            ],
            [
                'dribbble',
                'Dribbble',
                'fab fa-dribbble',
                '<i class="bi bi-dribbble"></i>',
            ],
            [
                'youtube',
                'Youtube',
                'fab fa-youtube',
                '<i class="bi bi-youtube"></i>',
            ],
            [
                'linkedin',
                'LinkedIn',
                'fab fa-linkedin',
                '<i class="bi bi-linkedin"></i>',
            ],
            [
                'reddit',
                'Reddit',
                'fab fa-reddit',
                '<i class="bi bi-reddit"></i>',
            ],
            [
                'steam',
                'Steam',
                'fab fa-steam',
                '<i class="bi bi-steam"></i>',
            ],
            [
                'twitch',
                'Twitch',
                'fab fa-twitch',
                '<i class="bi bi-twitch"></i>',
            ],
            [
                'skype',
                'Skype',
                'fab fa-skype',
                '<i class="bi bi-skype"></i>',
            ],
            [
                'personal_website',
                'Personal Website',
                'fa fa-external-link-alt',
                '<i class="bi bi-link-45deg"></i>',
            ],
            [
                'email',
                'Email',
                'fa fa-envelope',
                '<i class="bi bi-envelope-at"></i>',
            ],
            [
                'phone',
                'Phone',
                'fa fa-phone-square',
                '<i class="bi bi-telephone"></i>',
            ],
            [
                'tiktok',
                'TikTok',
                'fa fa-tiktok',
                '<i class="bi bi-tiktok"></i>',
            ],
        ],
    ],
    'user' => [
        'registration' => [
            'email_registration' => true,
            'display_username_field' => false,
        ],
    ],
    'mail' => [
        'method' => 'smtp',
        'methods' => [
            'smtp' => [
                'server' => (isset($_ENV['MAIL_SERVER']) ? $_ENV['MAIL_SERVER'] : (isset($_SERVER['MAIL_SERVER']) ? $_SERVER['MAIL_SERVER'] : 'mail.authsmtp.com')),
                'port' => (isset($_ENV['MAIL_PORT']) ? $_ENV['MAIL_PORT'] : (isset($_SERVER['MAIL_PORT']) ? $_SERVER['MAIL_PORT'] : '25')),
                'username' => (isset($_ENV['MAIL_USERNAME']) ? $_ENV['MAIL_USERNAME'] : (isset($_SERVER['MAIL_USERNAME']) ? $_SERVER['MAIL_USERNAME'] : '')),
                'password' => (isset($_ENV['MAIL_PASSWORD']) ? $_ENV['MAIL_PASSWORD'] : (isset($_SERVER['MAIL_PASSWORD']) ? $_SERVER['MAIL_PASSWORD'] : '')),
                'encryption' => (isset($_ENV['MAIL_ENCRYPTION']) ? $_ENV['MAIL_ENCRYPTION'] : (isset($_SERVER['MAIL_ENCRYPTION']) ? $_SERVER['MAIL_ENCRYPTION'] : '')),
                'messages_per_connection' => (isset($_ENV['MAIL_MESSAGES_PER_CONNECTION']) ? $_ENV['MAIL_MESSAGES_PER_CONNECTION'] : (isset($_SERVER['MAIL_MESSAGES_PER_CONNECTION']) ? $_SERVER['MAIL_MESSAGES_PER_CONNECTION'] : null)),
            ],
        ],
    ],
];
