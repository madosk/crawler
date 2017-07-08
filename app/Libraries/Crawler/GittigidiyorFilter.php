<?php

namespace App\Libraries\Crawler;

use App\Libraries\Crawler\CrawlerFilter;

class GittigidiyorFilter extends CrawlerFilter {
    
    public function __construct($site, $node) {
        parent::__construct($site, $node);
    }
    
    public function filter(){
        return ['url' => $this->node, 'type' => $this->getNodeType()];
    }
}