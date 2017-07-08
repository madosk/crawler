<?php

namespace App\Controllers;

use App\Models\Site;

class HomeController extends BaseController {
    
    public function index($request, $response) {
        $this->logger->addInfo('Homecontroller running!');
        
        $result = Site::find(1)->first();
        
        die(print_r($result->title));
        
        
        return $this->view->render($response, 'home/index.phtml');
    }
    
}