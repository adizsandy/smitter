<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpFoundation\Session\Session as Parent_Session;

class Session extends Parent_Session {

	public function __construct ()  
	{ 
		parent::__construct(); 
	}

	public function init() 
	{
		$this->start();
	}

} 