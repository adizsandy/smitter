<?php

namespace Symfox\Component\Collector;

class EventCollection extends Collector{

	public $events;

	public function __construct(){

		parent::__construct();

		if(!empty($this->map['events'])){
			$this->events = require __DIR__.'/../../../../'.$this->map['events'];
		}
	}
}