<?php

namespace Symfox;

class RouteCollection extends Collector{

	private $routes;

	public function __construct(){

		$this->routes = require_once $this->map['routes'];
	}
}