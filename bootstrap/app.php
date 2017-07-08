<?php
/**
 *  Slim Application settings
 *  and bootstrapping
 */

// Include composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Application settings
$settings = require __DIR__ . '/../config/settings.php';

// New Application instance
$app = new \Slim\App($settings);

// Application dependencies container
require __DIR__ . '/../app/dependencies.php';

// Routing
require __DIR__ . '/../app/routes.php';