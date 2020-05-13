<?php

namespace Symfox\Component\Collector;

class Collector {

	public $map = [];

	public function __construct()
	{	
		$this->map = require __DIR__.'/../../../../core/config/map.php';
		return $this->map;
	}
}

          
