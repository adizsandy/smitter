<?php

namespace App\Main\Module\Auth\Entity;

use Symfox\Auth\BaseAuth;

class UserAuth extends BaseAuth {

    // Model associated with the auth entity
    // optional if table name provided
    protected $model = App\Module\Main\Module\Model\User::class; 

    // Table name can also be used in the place of model
    // This property is optional and should only be used 
    // if there are no models associated with auth entity
    protected $table = 'random_users'; 

    // Auth Identifier column of table
    protected $identifier = 'email_address'; 

    // Auth identifier password of table
    protected $password = 'password'; 

    // If login is successful, name of the columns to be returned as result
    // for that matching sset of parameters
    // By default, only `id` of column would be available within result 
    protected $retrievable = [
        'first_name', 
        'last_name',
        'email_address',
        'phone',
        'street_address'
    ]; 

    // Session key prefix to be used as custom key for session
    // By default session keys would be like `<model_name_smallcase>.<session_property_name>`
    protected $sessionKeyPrefix = '007_xmu_';
}