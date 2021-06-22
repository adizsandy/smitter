<?php

// ROUTE DECLARATION FILE FOR GIVEN MODULE
return [
    'home' => [ '/' , 'HomeController::index' ], 
    'test' => [ '/test' , 'HomeController::test' ], 
    'contact' => [ '/contact' , 'HomeController::contact' ], 
    'user_login' => [ '/user/login' , 'UserController::login' ],
    'user_register' => [ '/user/register', 'UserController::register' ],
    'user_logout' => [ '/user/logout', 'UserController::logout' ],
    'user_update' => [ '/user/update', 'UserController::update' ]
];