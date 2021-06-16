<?php

return [
	
	// An awesome application name
	'name' => $_SERVER['APP_NAME'],

	// Application key
	'key' => $_SERVER['APP_KEY'],

	// Development environment 'prod' or 'local'
	'env' => $_SERVER['APP_ENV'],

	'debug' => $_SERVER['APP_DEBUG'],

	'url' => $_SERVER['APP_URL'],

	/** 
	* SERVICE CONTAINER
	* 
	* Services with no `abstraction` cannot be injected by type-hint
	* Service fetching by container would be available for the same
	* 
	* Note: All services are autowired by default
	*/
	'services' => [
   
	   // Default services 
	   'request' => [ 
		   'abstract' => Symfox\Request\RequestInterface::class,
		   'concrete' => \Symfox\Request\RequestAction::class, 
	   ],  
	   'response' => [ 
		   'abstract' => \Symfox\Response\ResponseInterface::class,
		   'concrete' => \Symfox\Response\ResponseAction::class, 
	   ],
	   'filehandler' => [ 
		   'abstract' => \Symfox\Filehandler\FilehandlerInterface::class,
		   'concrete' => \Symfox\Filehandler\Filehandler::class 
	   ], 
	   'mailer' => [ 
		   'abstract' => \Symfox\Mail\MailerInterface::class,
		   'concrete' => \Symfox\Mail\Mailer::class 
	   ], 
	   'db' => [ 
		   'abstract' => \Symfox\Persistance\PersistanceFactoryInterface::class,
		   'concrete' => \Symfox\Persistance\PersistanceFactory::class
	   ], 
	   'session' => [ 
		   'abstract' => Symfony\Component\HttpFoundation\Session\SessionInterface::class,
		   'concrete' => Symfony\Component\HttpFoundation\Session\Session::class 
	   ], 
	   'hasher' => [ 
		   'abstract' => Symfox\Security\PasswordHasherFactoryInterface::class,
		   'concrete' => Symfox\Security\PasswordHasherFactory::class
	   ],
	   'csrf' => [ 
		   'abstract' => Symfony\Component\Security\Csrf\CsrfTokenManagerInterface::class,
		   'concrete' => Symfony\Component\Security\Csrf\CsrfTokenManager::class
	   ],
	   'auth' => [ 
		   'abstract' => \Symfox\Security\AuthInterface::class,
		   'concrete' => \Symfox\Security\Auth::class 
	   ],  
	   'viewcache' => [ 
		   'abstract' => \Symfox\View\ViewInterface::class,
		   'concrete' => \Symfox\View\ViewCache::class 
	   ], 
	   'view' => [ 
		   'concrete' => \Symfox\View\View::class 
	   ],    
	   'matcher' => [ 
		   'abstract' => \Symfox\Match\MatchFactoryInterface::class,
		   'concrete' => \Symfox\Match\MatchFactory::class 
	   ],   
	   'dispatcher' => [ 
		   'abstract' => Symfony\Component\EventDispatcher\EventDispatcherInterface::class,
		   'concrete' => \Symfox\Dispatch\Dispatch::class 
	   ],
	   'control' => [ 
		   'abstract' => Symfony\Component\HttpKernel\Controller\ControllerResolverInterface::class,
		   'concrete' => Symfony\Component\HttpKernel\Controller\ControllerResolver::class 
	   ],
	   'kernel' => [  
		   'concrete' => Boot\Kernel::class 
	   ]
   
	   // Register custom services from here
   ]
];