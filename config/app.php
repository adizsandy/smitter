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
		   'abstract' => Smitter\Request\RequestInterface::class,
		   'concrete' => \Smitter\Request\RequestAction::class, 
	   ],  
	   'response' => [ 
		   'abstract' => \Smitter\Response\ResponseInterface::class,
		   'concrete' => \Smitter\Response\ResponseAction::class, 
	   ],
	   'filehandler' => [ 
		   'abstract' => \Smitter\Filehandler\FilehandlerInterface::class,
		   'concrete' => \Smitter\Filehandler\Filehandler::class 
	   ], 
	   'mailer' => [ 
		   'abstract' => \Smitter\Mail\MailerInterface::class,
		   'concrete' => \Smitter\Mail\Mailer::class 
	   ], 
	   'db' => [ 
		   'abstract' => \Smitter\Persistance\PersistanceFactoryInterface::class,
		   'concrete' => \Smitter\Persistance\PersistanceFactory::class
	   ], 
	   'session' => [ 
		   'abstract' => Symfony\Component\HttpFoundation\Session\SessionInterface::class,
		   'concrete' => Symfony\Component\HttpFoundation\Session\Session::class 
	   ], 
	   'hasher' => [ 
		   'abstract' => Smitter\Security\PasswordHasherFactoryInterface::class,
		   'concrete' => Smitter\Security\PasswordHasherFactory::class
	   ],
	   'csrf' => [ 
		   'abstract' => Symfony\Component\Security\Csrf\CsrfTokenManagerInterface::class,
		   'concrete' => Symfony\Component\Security\Csrf\CsrfTokenManager::class
	   ],  
	   'viewcache' => [ 
		   'abstract' => \Smitter\View\ViewInterface::class,
		   'concrete' => \Smitter\View\ViewCache::class 
	   ], 
	   'view' => [ 
		   'concrete' => \Smitter\View\View::class 
	   ],    
	   'matcher' => [ 
		   'abstract' => \Smitter\Match\MatchFactoryInterface::class,
		   'concrete' => \Smitter\Match\MatchFactory::class 
	   ],   
	   'dispatcher' => [ 
		   'abstract' => Symfony\Component\EventDispatcher\EventDispatcherInterface::class,
		   'concrete' => \Smitter\Dispatch\Dispatch::class 
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