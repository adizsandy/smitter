<?php

namespace Symfox\Component\Collector;

class ConnCollection extends Collector{

	public $conParam;

	public function __construct(){
		$collection   = new Collector();

		parent::__construct();

		if(!empty($this->map['config'])){
			$this->conParam = require __DIR__.'/../../../../core/'.$this->map['config'];
		}
	}
}