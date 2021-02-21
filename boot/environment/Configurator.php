<?php

namespace Boot\Env;

final class Configurator {

    // protected $connection;
    // protected $transport;
    // protected $config;
    // protected $modules;
    // protected static $structure = [];

    public function __construct()
    {   
        // $this->config = require __DIR__. '/../config/app.php';
        // $this->setConnection();
        // $this->setMailTransport();
        // $this->setModules();
        // $this->setStructure();
    }

    public static function getCachepath() 
    {

    }

    public static function getViewCacheTime() 
    {

    }

    public static function getAppKey() 
    {

    }

    public static function getProjectRoot() 
    {

    }

    public static function getHashType() 
    {
        return 'common';
    }

    public static function getRouteCollection() 
    {

    }

    public static function getEventCollection() 
    {

    }

    public static function getModuleDir() 
    {
        
    }

    public static function getListeners() 
    {

    }

    public static function getConnectionDetails () 
    {

    }

    protected function getAppConfiguration() 
    {

    }

    public static function getModuleCollection() 
    {

    }

    public static function getMailTransportCollection() 
    {

    }

    protected function getModules() 
    {
        return $this->modules;
    }

    protected function setModules() 
    {
        $this->modules = require_once(__DIR__.'/../../config/modules.php');
    }

    public static function getStructure() 
    {
        return $this->structure;
    }

    protected function setStructure() 
    {   
        if (! empty($this->getModules()) && count($this->getModules()) > 0) {
            foreach ($this->getModules() as $module_name => $config ) {
                if ($config['active']) { 
                    $module_path = implode('/', explode("_", ltrim($module_name, 'App_')) );
                    $folder = str_replace("\\", '/', __DIR__. '/' .$module_path); 
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

        // Set Application Directory
        $this->structure['dir'] = __DIR__;
    }

    private function setConnection() 
    {
        $this->connection = $this->config['database'];
    }

    public function getConnection() 
    {
        return $this->connection;
    }

    private function setMailTransport() 
    {   
        $this->transport = $this->config['mail']['default'];  
    }

    public function getMailTransport() 
    {
        return $this->transport;
    }

}