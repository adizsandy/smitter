<?php

namespace Symfox\Dispatch;

use Boot\Env\Configurator;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Dispatch {

	private $dispatcher;
	private $events = [];
	private $listeners = [];

	public function __construct()
	{	
		$this->setDispatcher();
		$this->setEvents();
		$this->setListeners();
	}

	protected function setDispatcher() 
	{
		$this->dispatcher = new EventDispatcher(); 
	}

	public function addEventListener($event_name, $event, $listener) 
	{
		if (!isset(($this->getEvents())[$event_name])) {
			($this->getEvents())[$event_name] = $event();
			if (is_array($listener)) {
				foreach ($listener as $l) {
					($this->getListeners())[$event_name][] = $l;
				} 
			} else {
				($this->getListeners())[$event_name][] = $listener;
			}
		} else {
			($this->getListeners())[$event_name][] = $listener;
		}
	}

	public function getEvents() 
	{
		return $this->events;
	}

	protected function setEvents() 
	{
		$this->events = Configurator::getEventCollection(); 
	}

	public function getListeners() 
	{
		return $this->listeners;
	}

	protected function setListeners() 
	{
		$this->listeners = Configurator::getListeners();
	}

	public function resolve($request, $response)
	{
		if ( !empty($this->getEvents()) && count($this->getEvents()) > 0 ) {
            foreach( $this->getEvents() as $e_name => $event){
                if(!empty($this->listeners[$e_name])){
                    foreach($this->listeners[$e_name] as $listener){
                        $this->dispatcher->addSubscriber(new $listener());
                    }
                    $this->dispatcher->dispatch($e_name, new $event($response, $request));
                } 
            }
        }

		return;
	}
} 