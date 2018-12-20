<?php

namespace Symfox;

use Component\Action;
use Component\Collector;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Processor 
{
	protected $dispatcher;
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    public function __construct(){

    	$events = new \EventCollection();
    	$listeners = new \ListenerCollection();
        $routes = new \RouteCollection();
    	
        $this->dispatcher = $this->call_dispatch($events, $listeners);
        $this->matcher = $this->call_match($routes);
        $this->controllerResolver = $this->call_control();
        $this->argumentResolver = $this->call_argument();
    }

    private function call_match(){

        $matchProcessor = new Match($routes);
        return $matchProcessor;
    }

    private function call_dispatch($events, $listeners){

    	$dispatchProcessor = new Dispatch($events, $listeners);
    	return $dispatchProcessor;
    }

    private function call_control(){
        $controlProcessor = new Control();
        return $controlProcessor;
    }

    private function call_argument(){
        $argumentProcessor = new Argument();
        return $argumentProcessor;
    }

}