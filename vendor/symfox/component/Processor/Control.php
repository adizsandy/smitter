<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Control{

	private $options;

	public function __construct($options){
		//....
		$this->options = $options;
	}

	public function getResolver(){
		return new ControllerResolver();
	}

	public function handleRequest($control, $args){
		$control[0]->db = $this->options[0];
		$control[0]->fn = $this->options[1];
		
		return call_user_func_array($control, $args);
	}

	public function view($html){

	}

} 