<?php

namespace Symfox\Component\Processor;

use Symfox\Component\Collector;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Processor 
{
    protected $dispatcher;
    protected $matcher;
    protected $controlProcessor;
    protected $argumentResolver;

    public function __construct(){
        
        $event = new \Symfox\Component\Collector\EventCollection();
        $listen = new \Symfox\Component\Collector\ListenerCollection();
        $this->dispatcher           = $this->call_dispatch($event, $listen);
       
        $routes = new \Symfox\Component\Collector\RouteCollection();
        $this->matcher              = $this->call_match($routes);

        $db = $this->call_persistance(new \Symfox\Component\Collector\ConnCollection());
        $fn = $this->call_function(new \Symfox\Component\Collector\FnCollection());
        $this->controlProcessor     = $this->call_control([$db,$fn->fn]);

        $this->argumentResolver     = $this->call_argument();
    }

    private function call_match($routes){
        $matchProcessor = new Match($routes);
        return $matchProcessor->getMatcher();
    }

    private function call_dispatch($events, $listeners){
    	$dispatchProcessor = new Dispatch($events, $listeners);
    	return $dispatchProcessor;
    }

    private function call_control($arg){
        $controlProcessor = new Control($arg);
        return $controlProcessor;
    }

    private function call_argument(){
        $argumentProcessor = new Argument();
        return $argumentProcessor->getResolver();
    }

    private function call_persistance($conn){
        $persistProcessor = new Persistance($conn);
        return $persistProcessor->getCapsule();
    }

    private function call_function($fn){
        return $fn;
    }

    private function process_view(){
        return new View();
    }

    public static function provide_component($name){

        $action = "process_".$name;
        
        if(method_exists(__CLASS__, $action)){
             return self::$action();
        }
    }

}