<?php

use Concrete\Core\Application\Application;

/*
 * ----------------------------------------------------------------------------
 * Instantiate Concrete
 * ----------------------------------------------------------------------------
 */
$app = new Application();

/*
 * ----------------------------------------------------------------------------
 * Detect the environment based on the hostname of the server
 * ----------------------------------------------------------------------------
 */
$app->detectEnvironment([
    'mamp' => [
        'Lees-MacBook-Pro.local',
        'Hannahs-MacBook-Pro.local',
        'Davids-MacBook-Pro.local'
    ],
    'staging' => [
        'staging1.limegreentangerine.net'
    ]
]);

return $app;
