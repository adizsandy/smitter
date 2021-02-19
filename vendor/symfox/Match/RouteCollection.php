<?php

namespace Symfox\Match;

use Symfox\Processor\Collector;

class RouteCollection extends Collector {

	public function __construct()
	{
		// parent::__construct();

		// if (!empty($this->map['routes'])) {
		// 	$this->routes = require __DIR__.'/../../../../core/'.$this->map['routes'];
		// }

		return $this->getRoutes();
	}
}