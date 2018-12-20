<?php

namespace Symfox;

class ListenerCollection extends Collector{

	private $listeners;

	public function __construct(){

		$this->listeners = require_once $this->map['listeners'];
	}
}