<?php

namespace App\Libraries\Crawler;

class CrawlerFilter {
    
    const URL_TYPE_ANY = 0;
    const URL_TYPE_HOME_PAGE = 1;
    const URL_TYPE_CATEGORY_PAGE = 2;
    const URL_TYPE_PRODUCT_PAGE = 3;
    
    protected $node;
    protected $site;

    public function __construct($site, $node) {
        $this->node = $node;
        $this->site = $site;
        
        $this->nodeToUri();
    }
    
    protected function nodeToUri() {
        if(substr($this->node, 0, 1) == '/' && substr($this->node, 0, 2) != '//') {
            $this->node = $this->site->url . $this->node;
        } else if(substr($this->node, 0, 2) == '//') {
            $this->node = str_ireplace('//', $this->site->url, $this->node);
        }

        $pu = parse_url($this->node);
        $this->node = @$pu['scheme'] . '://' . @$pu['host'] . @$pu['path'];
    }
    
    protected function getNodeType() {
        return self::URL_TYPE_ANY;
    }

    public function filter() {
        return ['url' => $this->node, 'type' => $this->getNodeType()];
    }
}