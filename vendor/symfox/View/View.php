<?php

namespace Symfox\View;

use Symfox\View\ViewTraits;
use Symfox\Cache\Cache;
use Boot\Env\Configurator;
use Symfox\Response\ResponseAction;

class View {

	use ViewTraits;

	private $layout;
	private $template;
	private $data;  

	public function __construct()
	{ 
		$this->setFileHandleService();
		$this->setSessionService();  
		$this->setAuthService();  
	}

	public function getIncludes($file, $module) 
	{	
		ob_start();
		if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP); 
		$include_file = Configurator::getModuleDir() . implode("/",explode("_", ltrim($module_name, 'App_'))) . '/Design/includes/' . $file . $this->getFileExtension();
		if (file_exists($include_file)) include_once $include_file;
		$includes = ob_get_contents();
		ob_end_clean(); 
		return $includes;
	}

	public function render ( $template = null, $options = null, $layout = null )
	{	
		if ($this->validCacheAvailable()) {
			$content = $this->getCacheContent();
		} else {
			$content = $this->generateContent($template, $options, $layout);
			$this->setCacheContent($content);
		} 
		return (new ResponseAction)->output($content);
	}

	public function generateContent($template = null, $options = null, $layout = null) 
	{
		if ( isset($layout) && ! empty($layout) )  { 
			$this->setLayout($layout);
		}
		if ( isset($template) && ! empty($template) ) { 
			$this->setTemplate($template); 
		}
		if ( isset($options) && ! empty($options) ) { 
			$this->setData($options); 
		}

		ob_start(); 
		if(!empty($this->getData())) extract($this->getData(), EXTR_SKIP); 
		require $this->getTemplate() . $this->getFileExtension(); 
		$templateContent = ob_get_contents(); 
		ob_end_clean();  

		ob_start(); 
		extract(['content' => $templateContent], EXTR_SKIP); 
		if (! empty($this->getLayout())) require $this->getLayout() . $this->getFileExtension(); 
		$final_content = ob_get_contents(); 
		ob_end_clean(); 

		return $final_content;
	}

	protected function getCacheKey() 
	{
		return md5($this->getRequest()->getUri() . ':' . Configurator::getAppKey());
	}

	protected function validCacheAvailable() 
	{	
		$file = 'view/' . $this->getCacheKey() . $this->getFileExtension();
		if ( Cache::has($file) ) {
			return true;
		}
		return false;  
	}

	protected function getCacheContent() 
	{	
		$file = 'view/' . $this->getCacheKey() . $this->getFileExtension();
		return Cache::get($file);
	}

	protected function setCacheContent($content) 
	{
		$file = 'view/' . $this->getCacheKey() . $this->getFileExtension();
		Cache::put($file, $content);
		return;
	}

	protected function setModuleDir($module = null) 
	{
		if (! empty($module)) {
			$module_name = $module;
		} else {
			$module_name = ( Configurator::getModuleCollection() ) [ $this->getRequest()->getUri() ]['module'];
		}
		$this->module = Configurator::getModuleDir() . implode("/",explode("_", ltrim($module_name, 'App_')));
	}

	protected function getModuleDir() 
	{
		return $this->module;
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

	public function setData($data) 
	{	
		if ( !empty($data) ) $this->data = $data; 
		return $this;
	}

	protected function getData() 
	{
		return $this->data;
	}

	private function getFileExtension() 
	{	
		return '.php'; 
	}

} 