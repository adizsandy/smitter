<?php

namespace Symfox;

class Collector{

	private $map;

	public function __construct(){

		$map = require_once __DIR__.'/../../../map.php';

		$this->map = $map;
	}
}