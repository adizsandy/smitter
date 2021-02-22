<?php

namespace Boot\Env;

final class Configurator {

    public static function getProjectRoot() 
    {
        return __DIR__ . '/../../';
    }

    public static function getModuleDir() 
    {
        return self::getProjectRoot() . 'app/modules/';
    }

    public static function getCachepath() 
    {
        return self::getProjectRoot() . 'storage/cache/';
    }

    public static function getViewCacheTime() 
    {
        $cachetime = require self::getProjectRoot() . 'config/cache.php';
        return $cachetime['cache_time']; 
    }

    public static function getAppKey() 
    {
        $app = require self::getProjectRoot() . 'config/app.php';
        return $app['key'];
    }

    public static function getHashType() 
    {
        $hash = require self::getProjectRoot() . 'config/hash.php';
        return $hash['hash_type'];
    }

    public static function getConnectionDetails () 
    {
        return require self::getProjectRoot() . 'config/database.php'; 
    }

    public static function getMailTransportCollection() 
    {
        return require self::getProjectRoot() . 'config/mail.php'; 
    }

    public static function getModuleCollection() 
    {
        return require self::getProjectRoot() . 'app/modules/register.php';
    }
    
    public static function getRouteCollection($module = null) 
    {   
        $route_collection = [];
        $collection = self::getModuleCollection();
        if ( !empty($collection) && count($collection) > 0 ) {
            foreach ( $collection as $name => $module ) {
                if ($module['active']) { // If a module is active, then only it can be registered
                    
                    // Get basic info about a module 
                    $module_id = ltrim($name, 'App_');
                    $module_prefix = strtolower($module_id); 
                    $module_dir = implode('/', explode("_", $module_id ) );
                    $module_path = self::getModuleDir() . $module_dir;
                    $all_info = require $module_path . '/module.php';   
                    
                    // Get module declarations
                    $declarations = $all_info['declarations'];

                    // Get registred routes
                    $routes = $all_info['routes'];
                    
                    // Set route mappings
                    if ( ! empty($routes) && count($routes) > 0 ) {
                        foreach ( $routes as $route_name => $detail ) {  
                            // Prepare prefixed url path
                            $final_url_path = '/'.rtrim(ltrim($declarations['url_prefix'].ltrim($detail[0], '/'), '/'), '/'); 
                            
                            // Prepare prefixed controller
                            $final_controller = str_replace("/", "\\", "App/Module/". $module_dir . '/Controller/');
                            
                            // add to collection
                            $route_collection[ $module_prefix . '_' . $route_name ] = [ $final_url_path, $final_controller . $detail[1] ];
                        }
                    }   
                } 
            }
        }
        return $route_collection; 
    }

    public static function getEventCollection() 
    {
        return []; // In dev
    }

    public static function getListeners() 
    {
        return []; // In dev
    }

}