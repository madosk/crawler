<?php
/**
 * Application routing configuration
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Example routing
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    //$response->getBody()->write("Hello, $name");
    $this->logger->addInfo("Hello request!");
    $db = $this->db;
    
    $this->logger->addInfo('Database connected:' . $db->getAttribute(PDO::ATTR_DRIVER_NAME));
    
    $response = $this->view->render($response, "hello.phtml", ["name" => $name]);
    
    return $response;
});

// Routing for controllers
$app->get('/', 'HomeController:index')->setName('home');

$app->get('/spider', 'SpiderController:index')->setName('spider');

$app->get('/crawler', 'Crawler:run')->setName('crawler');