<?php

namespace Symfox\Dispatch;

use Symfony\Component\EventDispatcher\EventDispatcher;

class Dispatch {

	private $dispatcher;
	private $events;
	private $listeners;

	public function __construct($events, $listeners)
	{	
		$this->dispatcher = new EventDispatcher(); 
		$this->events = $events;
		$this->listeners = $listeners;
	}

	public function resolve($request, $response)
	{
		if(!empty($this->events)){
            foreach($this->events as $e_name => $event){
                if(!empty($this->listeners[$e_name])){
                    foreach($this->listeners[$e_name] as $l_name => $listener){
                        $this->dispatcher->addSubscriber(new $listener());
                    }
                    $this->dispatcher->dispatch($e_name, new $event($response, $request));
                } 
            }
        }

		return;
	}
} 