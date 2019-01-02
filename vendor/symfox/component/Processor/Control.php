<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Control{

	private $options;
	private $view;

	public function __construct($options){
		$this->options = $options;
	}

	public function getResolver(){
		return new ControllerResolver();
	}

	public function handleRequest($control, $args){
		$this->setCustoms($control);
		return call_user_func_array($control, $args);
	}

	private function setCustoms($control){
		$control[0]->db 	= $this->options[0];
		$control[0]->fn 	= $this->options[1];
		$this->setViewProcessor($control[0]);

		return $control;
	}

	private function getViewProcessor(){
		$view = Processor::provide_component('view');
		return $view;
	}

	private function setViewProcessor($control){
		$view = $this->getViewProcessor();
		$control->view = $view;
	}

} 