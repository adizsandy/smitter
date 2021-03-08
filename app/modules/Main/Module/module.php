<?php

return [

    // Declare specification of module
    'declarations' => [
        'name' => 'App_Main_Module',
        'author' => 'Shudhansh Dubey',
        'url_prefix' => '/'
    ],

    // Register all routes for the given module
    'routes' => [  
        'home' => [ '/' , 'HomeController::index' ],
        'di' => ['/di', 'HomeController::di' ],
        'contact' => [ '/contact' , 'HomeController::contact' ],
        'user_login' => [ '/user/login' , 'UserController::login' ],
        'user_register' => [ '/user/register', 'UserController::register' ],
        'user_logout' => [ '/user/logout', 'UserController::logout' ],
        'user_update' => [ '/user/update', 'UserController::update' ],
    ],

];