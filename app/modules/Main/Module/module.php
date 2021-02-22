<?php

return [

    'declarations' => [
        'name' => 'App_Main_Module',
        'author' => 'Shudhansh Dubey',
        'url_prefix' => '/'
    ],

    'routes' => [
        'home' => [ '/' , 'HomeController::index' ],
        'main_contact' => [ '/contact' , 'HomeController::contact' ],
        'user_login_post' => [ '/user/login' , 'UserController::login' ],
        'user_register_post' => [ '/user/register', 'UserController::register' ],
        'user_logout_post' => [ '/user/logout', 'UserController::logout' ],
        'user_update_post' => [ '/user/update', 'UserController::update' ],
    ]

];