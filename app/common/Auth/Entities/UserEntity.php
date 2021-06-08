<?php

namespace App\Shared\Auth\Entity;

use Symfox\Security\Auth\DefaultEntity;

class UserEntity extends DefaultEntity {

    protected $table = 'random_users';
    
    protected $loginParams = [
        'identifier' => 'email_address',
        'secretkey' => 'password'
    ]; 
}