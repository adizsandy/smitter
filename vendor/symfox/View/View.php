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
	private $cacheallowed = true; 

	public function __construct()
	{ 
		$this->setFileHandleService();
		$this->setSessionService();  
		$this->setAuthService();  
		
		if ($_SERVER['APP_ENV'] == 'local') $this->cacheallowed = false;
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
			if ($this->cacheallowed) {
				$this->setCacheContent($content);
			} 
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

	protected function validCacheAvailable() 
	{	
		if ($this->cacheallowed) {
			$file = 'view/' . $this->getCacheKey() . $this->getFileExtension();
			if ( Cache::has($file) ) {
				return true;
			}
		} 
		return false;  
	}

	public function setCache($status = true) 
	{
		$this->cacheallowed = $status;
		return $this;
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