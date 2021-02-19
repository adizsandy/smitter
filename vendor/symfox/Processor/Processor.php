<?php

namespace Symfox\Processor;

use Symfox\Match\Matche;
use Symfox\Dispatch\Dispatch;
use Symfox\Controller\Control;
use Symfox\Argument\Argument;

 /**  
  * Processor Class
  * Handling all the processes for framework
  */
class Processor {
    
    protected $dispatcher;
    protected $matcher;
    protected $controlProcessor;
    protected $argumentResolver;
    protected $environment;
    protected $debug;
    protected $structure;

    public function __construct($env = 'local', $debug = true, $structure)
    {
        $this->environment = $env;
        $this->debug = $debug;
        $this->structure = $structure;
        $this->setDispatcher();
        $this->setMatcher();
        $this->setControlProcessor();
        $this->setArgumentResolver();
    }

    protected function setDispatcher() 
    {   
        $dispatchProcessor = new Dispatch($this->structure['events'], $this->structure['listeners']);
        $this->dispatcher = $dispatchProcessor;
    }

    public function getDispatcher() 
    {
        return $this->dispatcher;
    }

    protected function setMatcher() 
    {  
        $matchProcessor = new Matche($this->structure['route']);
        $this->matcher = $matchProcessor->getMatcher();
    }

    public function getMatcher() 
    {
        return $this->matcher;
    }

    protected function setControlProcessor() 
    {   
        $controlProcessor = new Control($this->structure['dir']);
        $this->controlProcessor = $controlProcessor;
    }

    public function getControlProcessor() 
    {
        return $this->controlProcessor;
    }

    protected function setArgumentResolver() 
    {   
        $argumentProcessor = new Argument();
        $this->argumentResolver = $argumentProcessor->getResolver();
    }

    public function getArgumentResolver() 
    {
        return $this->argumentResolver;
    }
}