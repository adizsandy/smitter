<?php

namespace Symfox\Security;

use Symfox\Security\PasswordHasherFactoryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfox\Persistance\PersistanceFactoryInterface;

/**
 * Auth Service Class
 */
class Auth implements AuthInterface {

    private $db;
    private $session;
    private $entity;
    private $hasher;

    public function __construct ( SessionInterface $session,  PersistanceFactoryInterface $persistance, PasswordHasherFactoryInterface $hasher ) 
    {
        $this->session = $session;
        $this->db = $persistance->getPersistance();
        $this->hasher = $hasher->getHasher();
    }

    protected function filterLoginData($data) 
    {   
        if ( is_array($data) && ! empty($data) ) {
            foreach($data as $k => $d) {
                if ($k == 'password') {
                    $data[$k] = $this->hasher->hash($d);
                }
            }
        } 
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
        return $this->session->get($this->entity);
    }

    public function logout() 
    {
        return $this->session->remove($this->entity);
    }

    public function hash($str) 
    {
        return $this->hasher->hash($str);
    }

    public function verify($hash, $str) 
    {
        return $this->hasher->verify($hash, $str);
    }

    public function entity($entity) 
    {
        $this->setEntity($entity);
        return $this;
    }
    
    public function check() 
    {
        return $this->session->has($this->getEntity());
    } 

    public function login($data) 
    {   
        if (! $this->check()) {
            $result = $this->db->table($this->getEntity())->where($this->filterLoginData($data))->first();
            if (! empty($result)) {
                $this->session->set($this->getEntity(), $result);
                return $result;
            } else {
                return false;
            }
        } 
    }
}