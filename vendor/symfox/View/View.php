<?php

namespace Symfox\View;

use Boot\Env\Configurator; 

class View {

	private $layout;
	private $template;
	private $data;  
	private $response; 
	private $viewcache;
	private $request;
	public $auth;
	public $session; 

	public function __construct()
	{ 	
		global $app; 
		$this->auth = $app->get('auth');
		$this->session = $app->get('session'); 
		$this->response = $app->get('response'); 
		$this->viewcache = $app->get('viewcache'); 
		$this->request = $app->get('request');
	}

	protected function resolve ( $template = null, $options = null, $layout = null ) 
	{
		if ($this->viewcache->validCacheAvailable()) {
			$content = $this->viewcache->getCacheContent();
		} else {
			if ( isset($layout) && ! empty($layout) )  { 
				$this->setLayout($layout);
			}
			if ( isset($template) && ! empty($template) ) { 
				$this->setTemplate($template); 
			}
			if ( isset($options) && ! empty($options) ) { 
				$this->setData($options); 
			}
			$content = $this->generateContent();
			if ($this->viewcache->cacheallowed) {
				$this->viewcache->setCacheContent($content);
			} 
		} 
		return $content;
	}

	protected function generateContent() 
	{
		ob_start(); 
		if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP); 
		require $this->getTemplate() . Configurator::getTemplateExtension(); 
		$templateContent = ob_get_contents(); 
		ob_end_clean();  

		ob_start(); 
		extract(['content' => $templateContent], EXTR_SKIP); 
		if (! empty($this->getLayout())) require $this->getLayout() . Configurator::getTemplateExtension(); 
		$final_content = ob_get_contents(); 
		ob_end_clean(); 

		return $final_content;
	}

	public function setlayout($layout, $module = null) 
	{	
		$this->setModuleDir($module);
		$this->layout = $this->getModuleDir() . '/Design/layouts/' . $layout; 
		return $this;
	}

	protected function getLayout() 
	{
		return $this->layout;
	}

	public function setTemplate($template, $module = null) 
	{	
		$this->setModuleDir($module);
		$this->template = $this->getModuleDir() . '/Design/templates/' . $template;
		return $this;
	}

	protected function getTemplate() 
	{
		return $this->template;
	}

	protected function setModuleDir($module = null) 
	{
		if (empty($module)) { // Current Request Module
			$module = Configurator::$route_attributes[ $this->request->getPathInfo() ]['module'];  
		}  
		$this->module = Configurator::getModuleDir() . implode("/",explode("_", ltrim($module, 'App_')));
	}

	protected function getModuleDir() 
	{
		return $this->module;
	}

	public function setData($data) 
	{	
		if ( !empty($data) ) $this->data = $data; 
		return $this;
	}

	protected function getData() 
	{
		return $this->data;
	}

	public function setCache($status = true) 
	{
		$this->viewcache->cacheallowed = $status;
		return $this;
	}

	public function getIncludes($file, $module) 
	{	
		ob_start();
		if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP); 
		$include_file = Configurator::getModuleDir() . implode("/",explode("_", ltrim($module, 'App_'))) . '/Design/includes/' . $file . Configurator::getTemplateExtension();
		if (file_exists($include_file)) include_once $include_file;
		$includes = ob_get_contents();
		ob_end_clean(); 
		return $includes;
	}

	public function render ( $template = null, $options = null, $layout = null )
	{	
		$content = $this->resolve($template, $options, $layout);
		return $this->response->output($content);
	}

} 