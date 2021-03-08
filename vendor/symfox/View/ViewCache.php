<?php

namespace Symfox\View;

use Boot\Env\Configurator;
use Symfox\Cache\Cache;

class ViewCache {
 
    private $request;
    public $cacheallowed = true;

    public function __construct()
    {   
        global $app; 
        if ($_SERVER['APP_ENV'] == 'local') $this->cacheallowed = false; 
        $this->request = $app->get('request');
    }

    public function validCacheAvailable() 
	{	
		if ($this->cacheallowed) {
			$file = 'view/' . $this->getCacheKey() . Configurator::getTemplateExtension();
			if ( Cache::has($file) ) {
				return true;
			}
		} 
		return false;  
	} 

	protected function getCacheContent() 
	{	
		$file = 'view/' . $this->getCacheKey() . Configurator::getTemplateExtension();
		return Cache::get($file);
	}

	protected function setCacheContent($content) 
	{
		$file = 'view/' . $this->getCacheKey() . Configurator::getTemplateExtension();
		Cache::put($file, $content);
		return;
	}

	protected function getCacheKey() 
	{
		return md5($this->request->getPathInfo() . ':' . Configurator::getAppKey());
	}

}