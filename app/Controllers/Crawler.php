<?php

namespace App\Controllers;

use Goutte\Client;
use App\Models\Site;

class Crawler extends Client {
    
    protected $anchors = [];

    public function run() {

        $sites = Site::all();

        foreach ($sites as $site) {
            if ($site->is_started == 0) {
                $this->start($site);
            }
        }
    }

    protected function start(Site $site) {
        $this->fetchAnchors($site);
        $urls = [];
        $node = NULL;
        $domainName = $this->getDomainName($this->getUrlHost($site->url));
        foreach ($this->anchors as $anchor) {
            $className = 'App\Libraries\Crawler\\' . $domainName . 'Filter';
            $filter = new $className($site, $anchor);
            $node = $filter->filter();
            if($node['url'] != NULL && strpos($node['url'], $this->getUrlHost($site->url)) !== FALSE) {
                $urls[] = $node;
            }
        }
        $this->anchors = $urls;
        
        $this->saveUrls();
    }
    
    /*
     * Fetch url and extract anchors
     */
    protected function fetchAnchors(Site $site) {
        $crawler = $this->request('GET', $site->url);
        $crawler->filter('a')->each(function($node){
            if(!in_array($node->attr('href'), $this->anchors) && !empty($node->attr('href'))) {
                $this->anchors[] = $node->attr('href');
            }            
        });
    }
    
    
    /*
     * It will not return real domainname
     * If domain is example.com then it will return Example
     */
    protected function getDomainName($domain) {
        $domainName = explode(".", $domain);
        return ucfirst($domainName[0]);
    }

    /*
     * Return host/domain of url without www
     */
    protected function getUrlHost($url) {
        return str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));
    }
    
    protected function saveUrls() {
        
    }

}
