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
        'main_contact' => [ '/contact' , 'HomeController::contact' ],
        'user_login_post' => [ '/user/login' , 'UserController::login' ],
        'user_register_post' => [ '/user/register', 'UserController::register' ],
        'user_logout_post' => [ '/user/logout', 'UserController::logout' ],
        'user_update_post' => [ '/user/update', 'UserController::update' ],
    ],

    // Register events and listeners
    'events' => [
        // Register listeners for default events
        'kernel.request' => [
            'handler' => \Symfony\Component\HttpKernel\Event\RequestEvent::class ,
            'listeners' => []
        ],
        'kernel.controller' => [
            'handler' => \Symfony\Component\HttpKernel\Event\ControllerEvent::class,
            'listeners' => []
        ],
        'kernel.controller_arguments' => [
            'handler' => \Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent::class,
            'listeners' => []
        ],
        'kernel.view' => [
            'handler' => \Symfony\Component\HttpKernel\Event\ViewEvent::class,
            'listeners' => []
        ],
        'kernel.terminate' => [
            'handler' => \Symfony\Component\HttpKernel\Event\TerminateEvent::class,
            'listeners' => []
        ],
        // You may register any custom event/listeners here
        'order.created' => [
            'handler' => \App\Module\Api\Order\Event\OrderEvent::class,
            'listeners' => []
        ],
    ]

];