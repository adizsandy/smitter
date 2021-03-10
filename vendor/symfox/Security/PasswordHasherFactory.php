<?php

namespace Symfox\Security;

use Boot\Env\Configurator;
use Boot\Env\Definitions; 
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory as ParentHasher;

class PasswordHasherFactory extends ParentHasher implements PasswordHasherFactoryInterface {

    private $hasher;

    public function __construct()
    {   
        $definitions = Definitions::getHashAlgorithms();
        $parent_hasher = new ParentHasher($definitions); 
        $this->hasher = $parent_hasher->getPasswordHasher(Configurator::getHashType());
    }

    public function getHasher() 
    {
        return $this->hasher;
    }

}