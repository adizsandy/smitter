<?php

use Symfox\Container\Container;

/**
 * Application/Service Container
 */

$app = new Container();

$bindings = require __DIR__ . '/container/services.php';

if (count($bindings) > 0) {
    foreach ($bindings as $id => $service) {
        if (is_array($service)) { // Factory // 0: Factory Class, 1: Callable
            $app->set($id, (new $service[0])->{$service[1]}() );
        } else { // Concrete
            $app->set($id, new $service());
        } 
    }
}

return $app;