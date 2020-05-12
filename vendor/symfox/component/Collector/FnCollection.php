<?php

namespace Symfox\Component\Collector;

class FnCollection extends Collector{

	public $fn;

	public function __construct(){
		$collection   = new Collector();

		parent::__construct();

		if(!empty($this->map['function'])){
			$this->fn = require __DIR__.'/../../../../core/'.$this->map['function'];
		}
	}
}