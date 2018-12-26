<?php

namespace Symfox\Component\Processor;

use Symfox\Component\Action;
use Symfox\Component\Collector;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Processor 
{
    protected $dispatcher;
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    public function __construct(){
        
        $this->dispatcher           = $this->call_dispatch(new \Symfox\Component\Collector\EventCollection(), new \Symfox\Component\Collector\ListenerCollection());
        $this->matcher              = $this->call_match(new \Symfox\Component\Collector\RouteCollection());
        $this->controllerResolver   = $this->call_control();
        $this->argumentResolver     = $this->call_argument();
    }

    protected function call_match($routes){

        $matchProcessor = new Match($routes);
        return $matchProcessor->getMatcher();
    }

    protected function call_dispatch($events, $listeners){

    	$dispatchProcessor = new Dispatch($events, $listeners);
    	return $dispatchProcessor;
    }

    protected function call_control(){
        $controlProcessor = new Control();
        return $controlProcessor->getResolver();
    }

    protected function call_argument(){
        $argumentProcessor = new Argument();
        return $argumentProcessor->getResolver();
    }

}