<?php

namespace Symfox\Component\Collector;

class RouteCollection extends Collector{

	public $routes;

	public function __construct(){
		$collection   = new Collector();

		parent::__construct();

		if(!empty($this->map['routes'])){
			$this->routes = require __DIR__.'/../../../../'.$this->map['routes'];
		}
	}
}