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
    protected $db;

    public function __construct(){
        
        $this->dispatcher           = $this->call_dispatch(new \Symfox\Component\Collector\EventCollection(), new \Symfox\Component\Collector\ListenerCollection());
        $this->matcher              = $this->call_match(new \Symfox\Component\Collector\RouteCollection());
        $this->controllerResolver   = $this->call_control();
        $this->argumentResolver     = $this->call_argument();
        $this->db = $this->call_persistance(new \Symfox\Component\Collector\ConnCollection());
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

    // protected function call_persistance($path, $conn){
    //     $persistProcessor = new Persistance($path,$conn);
    //     return $persistProcessor->getEntityManager();
    // }

    protected function call_persistance($conn){
        $persistProcessor = new Persistance($conn);
        return $persistProcessor->getCapsule();
    }

}