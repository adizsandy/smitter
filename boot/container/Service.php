<?php

/** Service Container Registry for All Services */

return [

    'response' => \Symfox\Response\ResponseAction::class,
    'db' => \Symfox\Persistance\Persistance::class,
    'auth' => \Symfox\Security\Auth::class,
    'session' => \Symfox\Session\Session::class,
    'filehandler' => \Symfox\Filehandler\Filehandler::class,
    'mailer' => \Symfox\Mail\Mailer::class,
    'cache' => \Symfox\Cache\Cache::class,
    'view' => \Symfox\View\View::class,
    'request' => \Symfox\Request\RequestAction::class
    
    // Register custom services here
];