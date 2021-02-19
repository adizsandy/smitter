<?php

namespace Symfox\Persistance;

use Symfox\Processor\Collector;

class ModelCollection extends Collector{

	public $paths;

	public function __construct(){
		$collection   = new Collector();

		parent::__construct();

		if(!empty($this->map['models'])){
			$this->paths = [ __DIR__.'/../../../../'.$this->map['models'] ];
		}
	}
}