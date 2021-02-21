<?php

namespace Symfox\Cache;

use Boot\Env\Configurator;
use Symfox\Filehandler\Filehandler;

class Cache {

    private static $cachepath;
    private static $filehandler;
    private static $cachetime;

    public function __construct()
    {   
        self::$cachepath = Configurator::getCachepath();
        self::$filehandler = (new Filehandler)->getHandler();
    }
    
    public static function has($file) 
    {
        if (self::$filehandler->has( self::$cachepath . $file)) {
			if ( ( time() - self::getExpiryTime() ) < self::$filehandler->getTimestamp($file) ) {
				return true;
			} else {
				self::$filehandler->delete(self::$cachepath . $file);
			}
		}
        return false;
    }

    public static function put($file, $content) 
    {
        self::$filehandler->put(self::$cachepath . $file, $content);
        return;
    }

    public static function get($file) 
    {
        return self::$filehandler->read(self::$cachepath . $file);
    }

    public static function getExpiryTime() 
    {
        return self::$cachetime;
    }

    public static function setExpiryTime($time) 
    {
        if ( empty($time) ) {
			self::$cachetime = Configurator::getViewCacheTime();
		} else if ($time == false) { 
			self::$cachetime = 0;
		} else {
			self::$cachetime = $time;
		}  
    }
}