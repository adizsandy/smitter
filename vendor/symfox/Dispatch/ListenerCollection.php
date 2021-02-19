<?php

namespace Symfox\Dispatch;

use Symfox\Processor\Collector;

class ListenerCollection extends Collector{

	public $listeners;

	public function __construct(){

		parent::__construct();

		if(!empty($this->map['listeners'])){
			$this->listeners = require __DIR__.'/../../../../core/'.$this->map['listeners'];
		}
	}
}