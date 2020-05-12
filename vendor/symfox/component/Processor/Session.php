<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Session {

	public function __construct () {}

	public function session () 
	{	
		$session_int = new SessionInterface;
		return $session_int;
	}

} 