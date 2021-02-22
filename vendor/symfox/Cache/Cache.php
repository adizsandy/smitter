<?php

namespace Symfox\Cache;

use Boot\Env\Configurator;
use Symfox\Filehandler\Filehandler;

class Cache {

    private static $cachepath;
    private static $filehandler;
    private static $cachetime;
    
    public static function has($file) 
    {   
        if (empty(self::$filehandler)) self::$filehandler = (new Filehandler)->getHandler();
        if (empty( self::$cachepath)) self::$cachepath = Configurator::getCachepath();

        if ( self::$filehandler->has( self::$cachepath . $file ) ) {
			if ( ( time() - self::getExpiryTime() ) < self::$filehandler->getTimestamp(self::$cachepath . $file) ) {
				return true;
			} else {
				self::$filehandler->delete(self::$cachepath . $file);
			}
		}
        return false;
    }

    public static function put($file, $content) 
    {   
        if (empty(self::$filehandler)) self::$filehandler = (new Filehandler)->getHandler();
        if (empty( self::$cachepath)) self::$cachepath = Configurator::getCachepath();

        self::$filehandler->put(self::$cachepath . $file, $content);
        return;
    }

    public static function get($file) 
    {   
        if (empty(self::$filehandler)) self::$filehandler = (new Filehandler)->getHandler();
        if (empty( self::$cachepath)) self::$cachepath = Configurator::getCachepath();

        return self::$filehandler->read(self::$cachepath . $file);
    }

    public static function getExpiryTime() 
    {   
        if (empty(self::$cachetime)) self::setExpiryTime();
        return self::$cachetime;
    }

    public static function setExpiryTime($time = null) 
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