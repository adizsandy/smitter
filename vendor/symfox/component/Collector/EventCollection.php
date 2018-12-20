<?php

namespace Symfox;

class EventCollection extends Collector{

	private $events;

	public function __construct(){

		$this->events = require_once $this->map['events'];
	}
}