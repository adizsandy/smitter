<?php

namespace Symfox\Security;

use Symfox\Persistance\Persistance;
use Symfony\Component\HttpFoundation\Session\Session; 
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;

/**
 * Auth Service Class
 */
class Auth {

    protected $db;
    protected $session;
    protected $entity;
    protected $hasher;

    public function __construct()
    {   
        $this->db = (new Persistance())->getPersistance();
        $this->session = new Session; 
        $this->setHasher();
    }

    public function entity($entity) 
    {
        $this->entity = strtolower($entity);
        return $this;
    }
	
    public function check() 
    {
        return $this->session->has($this->entity);
    } 

    public function login($data) 
    {   
        if (! $this->check()) {
            $result = $this->db->table($this->entity)->where($this->filterLoginData($data))->first();
            if (! empty($result)) {
                $this->session->set($this->entity, $result);
                return $result;
            } else {
                return false;
            }
        } 
    }

    protected function filterLoginData($data) 
    {   
        if (is_array($data) && ! empty($data)) {
            foreach($data as $k => $d) {
                if ($k == 'password') {
                    $data[$k] = $this->hasher->hash($d);
                }
            }
        } 
    }

    public function logout() 
    {
        return $this->session->remove($this->entity);
    }

    public function hash($str) 
    {
        return $this->getHasher()->hash($str);
    }

    public function verify($hash, $str) 
    {
        return $this->getHasher()->verify($hash, $str);
    }

    protected function setHasher($type = 'common') 
    {    
        // Hash a plain password
        // $hash = $passwordHasher->hash('plain'); // returns a bcrypt hash

        // // Verify that a given plain password matches the hash
        // $passwordHasher->verify($hash, 'wrong'); // returns false
        // $passwordHasher->verify($hash, 'plain'); // returns true (valid)

        $type_def = [
            'common' => ['algorithm' => 'bcrypt'],
            'memory-hard' => ['algorithm' => 'sodium'],
        ];
        $factory = new PasswordHasherFactory($type_def);
        $this->hasher = $factory->getPasswordHasher($type);
    }

    protected function gethasher() 
    {
        return $this->hasher;
    }

    public function data() 
    {
        return $this->session->get($this->entity);
    }
}