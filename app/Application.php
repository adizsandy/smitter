<?php

namespace App;

class Application {

    protected $modules;
    protected $structure = [];
    
    public function __construct() 
    {
        $this->setModules();
        $this->setStructure();
    }

    protected function getModules() 
    {
        return $this->modules;
    }

    protected function setModules() 
    {
        $this->modules = require_once(__DIR__.'/../config/modules.php');
    }

    public function getStructure() 
    {
        return $this->structure;
    }

    protected function setStructure() 
    {   
        if (! empty($this->getModules()) && count($this->getModules()) > 0) {
            foreach ($this->getModules() as $module_name => $config ) {
                if ($config['active']) { 
                    $module_path = implode('/', explode("_", ltrim($module_name, 'App_')) );
                    $folder = str_replace("\/", '/', __DIR__.'/modules/'.$module_path); 
                    $info = require_once $folder . '/module.php';
                    
                    // Set Route and Controller Map
                    $routes = require_once $folder . ltrim($info['route'], '.');
                    if (! empty($routes)) {
                        foreach ($routes as $route_name => $detail) {

                            $module_prefix = ltrim(strtolower($info['name']), "app_"); 
                            $final_url_path = '/'.rtrim(ltrim($info['url_prefix'].ltrim($detail[0], '/'), '/'), '/'); 
                            $final_controller = str_replace("/", "\\", "App/Module/". implode("/",explode("_", ltrim($module_name,'App_'))) . '/Controller/');
                            
                            $this->structure['route'][ $module_prefix . '_' . $route_name ] = [ $final_url_path, $final_controller . $detail[1] ];
                        }
                    }  

                    // Set Event Listeners
                    $this->structure['events'] = [];
                    $this->structure['listeners'] = [];
                } 
            }
        }
        
        // Set Database connection
        $app_config = require_once __DIR__. '/../config/app.php';
        $this->structure['connection'] = $app_config['database'];

        // Set Application Directory
        $this->structure['dir'] = __DIR__;
    }
}