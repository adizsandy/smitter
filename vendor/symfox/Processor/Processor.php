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
abstract class Processor {
    
    protected $dispatcher;
    protected $matcher;
    protected $controlProcessor;
    protected $argumentResolver;
    protected $environment;
    protected $debug; 

    public function __construct( $env = 'local', $debug = true )
    {
        $this->setEnvironment($env);
        $this->setDebug($debug); 
        $this->setDispatcher();
        $this->setMatcher();
        $this->setControlProcessor();
        $this->setArgumentResolver();
    }

    protected function setEnvironment($env) 
    {
        if ($env == 'prod') {
            ini_set('error_reporting', 0);
        } else {
            ini_set('error_reporting', E_ALL);
        }
    }

    protected function setDebug($debug) 
    {
        // In dev...
    }

    protected function setDispatcher() 
    {    
        $dispatchProcessor = new Dispatch();
        $this->dispatcher = $dispatchProcessor;
    }

    public function getDispatcher() 
    {
        return $this->dispatcher;
    }

    protected function setMatcher() 
    {   
        $matchProcessor = new Matche();
        $this->matcher = $matchProcessor->getMatcher();
    }

    public function getMatcher() 
    {
        return $this->matcher;
    }

    protected function setControlProcessor() 
    {   
        $controlProcessor = new Control();
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