<?php

namespace Symfox\Component\Processor;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Control {

	private $options;
	private $response;

	public function __construct($options)
	{
		$this->options = $options;
	}

	public function getResolver()
	{
		return new ControllerResolver();
	}

	public function handleRequest($control, $args)
	{	
		$control = $this->setCustoms($control);
		return call_user_func_array($control, $args);
	}

	private function setCustoms($control)
	{
		$control[0]->db = $this->options[0];
		$control[0]->fn = $this->options[1];
		$control[0] = $this->setSessionProcessor($control[0]);
		$control[0] = $this->setViewProcessor($control[0]); 
		$control[0] = $this->setResponseAction($control[0]); 
		
		return $control;
	}

	private function getViewProcessor(){
		$view = Processor::provide_component('view');
		return $view;
	}

	private function setViewProcessor($control)
	{
		$view = $this->getViewProcessor();
		$control->view = $view;
		return $control;
	}

	private function getSessionProcessor() 
	{
		$session = Processor::provide_component('session'); 
		return $session;
	}

	private function setSessionProcessor($control) 
	{
		$session = $this->getSessionProcessor();
		$session->init();
		$control->session = $session;
		return $control;
	}

	private function getResponseAction() 
	{
		$response = Processor::call_component('response'); 
		return $response;
	}

	private function setResponseAction($control) 
	{
		$response = $this->getResponseAction();
		$control->response = $response;
		return $control;
	}

} 