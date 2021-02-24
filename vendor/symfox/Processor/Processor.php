<?php

namespace Symfox\Processor;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfox\Dispatch\Dispatch;
use Symfox\Controller\Control; 
use Symfox\Match\Matche; 

 /**  
  * Processor Class
  * Handling all the processes for framework
  */
class Processor extends HttpKernel {
    
    protected $matcher;
    protected $environment;
    protected $debug; 

    public function __construct($env, $debug)
    {   
        $this->setEnvironment($env);
        $this->setDebug($debug); ; 

        parent::__construct( $this->getDispatcher(), $this->getControlResolver() ); 
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

    public function getMatcher() 
    {
        return ( new Matche() )->getMatcher();
    }

    public function getDispatcher() 
    {
        return ( new Dispatch() )->getDispatcher();
    }

    public function getControlResolver() 
    {
        return ( new Control() )->getResolver();
    }
}