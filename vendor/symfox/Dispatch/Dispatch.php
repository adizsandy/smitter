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

	public function getDispatcher() 
	{
		return $this->dispatcher;
	}

	protected function setDispatcher() 
	{
		$this->dispatcher = new EventDispatcher(); 
	}

	public function getEvents() 
	{
		if (empty($this->events)) $this->setEvents();
		return $this->events;
	}

	protected function setEvents() 
	{
		$this->events = Configurator::getEventCollection(); 
	}

	public function getListeners() 
	{	
		if (empty($this->listeners)) $this->setListeners();
		return $this->listeners;
	}

	protected function setListeners() 
	{
		$this->listeners = Configurator::getListeners();
	}

	public function resolve($request, $response)
	{
		if ( !empty($this->getEvents()) && count($this->getEvents()) > 0 ) {
            foreach( $this->getEvents() as $event_key => $event ) {
				$listeners = $this->getListeners($event_key);
                if ( count($listeners) > 0 ){
                    foreach ( $listeners as $listener ) {
                        $this->dispatcher->addSubscriber(new $listener());
                    }
                    $this->dispatcher->dispatch($event_key, new $event($response, $request));
                } 
            }
        }
		return;
	}
} 