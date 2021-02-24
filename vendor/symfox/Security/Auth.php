<?php

namespace Symfox\Security;

use Boot\Env\Configurator;
use Boot\Env\Definitions;
use Symfox\Persistance\Persistance;
use Symfony\Component\HttpFoundation\Session\Session; 
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;

/**
 * Auth Service Class
 */
class Auth {

    private $db;
    private $session;
    private $entity;
    private $hasher;

    protected function getSession() 
    {   
        if (empty($this->session)) $this->setSession();
        return $this->session;
    }

    protected function setSession() 
    {
        $this->session = new Session;
    }

    protected function getDB() 
    {   
        if (empty($this->db)) $this->setDB();
        return $this->db;
    }

    protected function setDB() 
    {
        $this->db = (new Persistance)->getPersistance();
    }

    protected function filterLoginData($data) 
    {   
        if (is_array($data) && ! empty($data)) {
            foreach($data as $k => $d) {
                if ($k == 'password') {
                    $data[$k] = $this->getHasher()->hash($d);
                }
            }
        } 
    }

    protected function setHasher() 
    {    
        $this->hasher = $this->getHasherFactory()->getPasswordHasher(Configurator::getHashType());
    }

    protected function getHasherFactory() 
    {
        return new PasswordHasherFactory(Definitions::getHashAlgorithms());
    }

    protected function gethasher() 
    {   
        if (empty($this->hasher)) $this->setHasher();
        return $this->hasher;
    }

    protected function setEntity($entity) 
    {
        $this->entity = strtolower($entity);
    }

    protected function getEntity() 
    {
        return $this->entity;
    }

    public function data() 
    {
        return $this->getSession()->get($this->entity);
    }

    public function logout() 
    {
        return $this->getSession()->remove($this->entity);
    }

    public function hash($str) 
    {
        return $this->getHasher()->hash($str);
    }

    public function verify($hash, $str) 
    {
        return $this->getHasher()->verify($hash, $str);
    }

    public function entity($entity) 
    {
        $this->setEntity($entity);
        return $this;
    }
    
    public function check() 
    {
        return $this->getSession()->has($this->getEntity());
    } 

    public function login($data) 
    {   
        if (! $this->check()) {
            $result = $this->getDB()->table($this->getEntity())->where($this->filterLoginData($data))->first();
            if (! empty($result)) {
                $this->getSession()->set($this->getEntity(), $result);
                return $result;
            } else {
                return false;
            }
        } 
    }
}