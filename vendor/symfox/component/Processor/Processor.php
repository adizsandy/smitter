<?php

namespace Symfox;

use Component\Action;
use Component\Collector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
//use Symfony\Component\HttpKernel\HttpKernelInterface;

class Processor 
{
	protected $dispatcher;
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    public function __construct(){

    	$events = new Collector\EventCollection();
    	$listeners = new Collector\ListenerCollection();

    	$this->dispatcher = $this->call_dispatch($events, $listeners);
    }

    private function call_dispatch($events, $listeners){

    	$dispatchProcessor = new Dispatch($events, $listeners);

    	return $dispatchProcessor;
    }

}