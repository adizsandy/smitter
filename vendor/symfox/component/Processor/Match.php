<?php

namespace Symfox;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Match{

	private $matcher;

	public function __construct($routes){
		
		$context = new RequestContext();
		$this->matcher = new UrlMatcher($routes, $context);
	}
} 