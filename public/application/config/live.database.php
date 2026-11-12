<?php

return [
    'default-connection' => 'concrete',
    'connections' => [
        'concrete' => [
            'driver' => 'c5_pdo_mysql',
            'server' => (isset($_ENV['DB_HOSTNAME']) ? $_ENV['DB_HOSTNAME'] : (isset($_SERVER['DB_HOSTNAME']) ? $_SERVER['DB_HOSTNAME'] : '')),
            'database' => (isset($_ENV['DB_DATABASE']) ? $_ENV['DB_DATABASE'] : (isset($_SERVER['DB_DATABASE']) ? $_SERVER['DB_DATABASE'] : '')),
            'username' => (isset($_ENV['DB_USERNAME']) ? $_ENV['DB_USERNAME'] : (isset($_SERVER['DB_USERNAME']) ? $_SERVER['DB_USERNAME'] : '')),
            'password' => (isset($_ENV['DB_PASSWORD']) ? $_ENV['DB_PASSWORD'] : (isset($_SERVER['DB_PASSWORD']) ? $_SERVER['DB_PASSWORD'] : '')),
            'character_set' => (isset($_ENV['DB_CHARSET']) ? $_ENV['DB_CHARSET'] : (isset($_SERVER['DB_CHARSET']) ? $_SERVER['DB_CHARSET'] : '')),
            'collation' => (isset($_ENV['DB_COLLATION']) ? $_ENV['DB_COLLATION'] : (isset($_SERVER['DB_COLLATION']) ? $_SERVER['DB_COLLATION'] : '')),
        ],
    ],
];
