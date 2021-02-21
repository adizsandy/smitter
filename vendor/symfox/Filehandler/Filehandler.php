<?php

namespace Symfox\Filehandler;

use Boot\Env\Configurator;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local; 

class Filehandler {

    private $handler;

    public function __construct()
    {
        $this->setHandler(Configurator::getProjectRoot()); 
    }

    public function getHandler() 
    {
        return $this->handler;
    }

    protected function setHandler($root) 
    {
        $adapter = new Local($root);
		$this->handler = new Filesystem($adapter); 
    }
}