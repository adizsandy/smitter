<?php

return [

    // Declare specification of module
    'declarations' => [
        'name' => 'Main_Module',
        'author' => 'Shudhansh Dubey',
        'version' => '1.0.0', // Module version
        'url_prefix' => '/', // define common prefix for all request paths
        'stateless' => false // State for given module is required or not, REST API or Non-API 
    ],

    // Register all routes for the given module
    'routes' => [  
        'home' => [ '/' , 'HomeController::index' ],
        'di' => ['/di', 'HomeController::di' ],
        'contact' => [ '/contact' , 'HomeController::contact' ],
        'focused' => [ '/focused' , 'HomeController::focused' ],
        'user_login' => [ '/user/login' , 'UserController::login' ],
        'user_register' => [ '/user/register', 'UserController::register' ],
        'user_logout' => [ '/user/logout', 'UserController::logout' ],
        'user_update' => [ '/user/update', 'UserController::update' ],
    ],

];
