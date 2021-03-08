<?php

/** Service Factory/Class Registry for All Services [ SERVICE CONTAINER ] */

return [

    // Public factories ( Public API Helpers )
    'request' => \Symfox\Request\RequestAction::class,
    'response' => \Symfox\Response\ResponseAction::class,
    'db' => \Symfox\Persistance\Persistance::class,
    'session' => \Symfox\Session\Session::class,
    'auth' => \Symfox\Security\Auth::class, 
    'filehandler' => \Symfox\Filehandler\Filehandler::class,
    'mailer' => \Symfox\Mail\Mailer::class, 
    'viewcache' => \Symfox\View\ViewCache::class, 
    'view' => \Symfox\View\View::class,  
    
    // Private factories ( No API helpers )
    'control' => [ \Symfox\Controller\ControlFactory::class, 'get' ],
    'matcher' => \Symfox\Match\MatchFactory::class,
    'dispatcher' => [ \Symfox\Dispatch\DispatchFactory::class, 'get' ],

    // Register custom services here
];