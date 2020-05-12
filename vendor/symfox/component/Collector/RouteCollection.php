<?php

namespace Symfox\Component\Collector;

class RouteCollection extends Collector {

	public $routes;

	public function __construct()
	{
		parent::__construct();

		if (!empty($this->map['routes'])) {
			$this->routes = require __DIR__.'/../../../../core/'.$this->map['routes'];
		}
	}
}