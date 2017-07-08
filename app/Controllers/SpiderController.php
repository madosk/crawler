<?php

namespace App\Controllers;

use Goutte\Client;

class SpiderController extends BaseController {
    
    // Websites will crawl
    protected $websites = [
        'http://www.gittigidiyor.com',
    ];


    protected $urls;

    public function index($request, $response) {
        
        $client = new Client();
        
        $crawler = $client->request('GET', $this->websites[0]);
        
        $crawler->filter('a')->each(function ($node) {
            $url = substr($node->attr('href'), 0, 1) == '/' ? $this->websites[0] . $node->attr('href') : $node->attr('href');
            $pu = parse_url($this->websites[0]);

            if(preg_match('/' . $pu['host'] . '/', $url) == 1) {
                $this->urls[] = $url;
            }
        });
        
        $this->urls = array_unique($this->urls);
        
        
        echo '<pre>';
        print_r($this->urls);
        die();
        
        return $this->view->render($response, 'spider.phtml');
    }
    
}