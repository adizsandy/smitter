<?php

namespace Boot;

use DI\ContainerBuilder;
use ReflectionClass;

/**
 * Application/Service Container
 */
class Application {

    private $builder;
    private $bindings = [];
    private $key_bindings = [];
    private $container;

    public function __construct()
    {
        $this->builder = new ContainerBuilder;
        $this->services = require __DIR__ . '/container/services.php'; 
        $this->resolveBindings();
        $this->builder->addDefinitions($this->bindings);
        $this->container = $this->builder->build();
        $this->setKeyBindings();
    }

    public function make() 
    { 
        return $this->container;
    }

    protected function setKeyBindings() 
    {
        if ( count($this->key_bindings) > 0 ) {
            foreach ( $this->key_bindings as $key => $instance ) {
                $this->container->set($key, $instance);
            }
        } 
    }

    protected function resolveBindings() 
    {   
        $services = $this->services;
        if ( count($services) > 0 ) {
            foreach ( $services as $key => $definition ) {
                
                // Get Resolved Instance 
                $instance = $this->resolveArgumentsInjection($definition['concrete']);

                // Abstract Assignment to Implementation if applicable
                if (isset($definition['abstract'])&&!empty($definition['abstract'])) { 
                    $this->bindings[$definition['abstract']] = $instance; 
                } 

                // Set Key Bindings for Services
                $this->key_bindings[$key] = $instance;   
            }
        }    
    }

    protected function resolveArgumentsInjection($class) 
    {
        $ref = new ReflectionClass($class);
        $constructor = $ref->getConstructor();
        $args = $constructor->getParameters();
        $mod_args = [];
        if (count($args) > 0) {
            foreach ($args as $a) {
                if (!empty($a->getType())) {
                    $name = $a->getType()->getName();
                    if (array_key_exists($name, $this->bindings)){
                        $mod_args[] = $this->bindings[$name];
                    }
                } else {
                    $mod_args[] = $a->getDefaultValue();
                }
            }
        }
        return $ref->newInstanceArgs($mod_args);
    }

}
