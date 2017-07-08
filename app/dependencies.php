<?php
/**
 * Application dependencies container instances
 */

// Get container
$container = $app->getContainer();

// Set logger
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

// Service factory for the ORM
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Set db engine
$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

// Set view template engine
$container['view'] = new \Slim\Views\PhpRenderer("../views/");

// Controllers definations
$container['HomeController'] = function($container) {
    return new \App\Controllers\HomeController($container);
};

$container['SpiderController'] = function($container) {
    return new \App\Controllers\SpiderController($container);
};

$container['Crawler'] = function($container) {
    return new \App\Controllers\Crawler();
};

