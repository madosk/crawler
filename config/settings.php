<?php
/**
 * Main application configuration
 */

return [
    "settings" => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'crawler',
            'username' => 'root',
            'password' => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_turkish_ci',
            'prefix'    => '',
        ]
    ]
];