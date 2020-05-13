<?php
/**
 * Symfox : Melting the Rocks of PHP 
 * 
 * @version 0.0.3 | Alfa  
 * @author Shudhansh Dubey < sudhanshs4@gmail.com >
 * @link https://adizsandy@bitbucket.org/adizsandy/symfox.git
 * @copyright 2019 Symfox, All rights reserved
 * @license MIT
 */

namespace Symfox\Component\Processor;

 /**  
 * Processor Class
 * Handling all the processes for framework
 * 
 */
class Processor
{
    protected $dispatcher;
    protected $matcher;
    protected $controlProcessor;
    protected $argumentResolver;

    public function __construct()
    {
        $event = new \Symfox\Component\Collector\EventCollection();
        $listen = new \Symfox\Component\Collector\ListenerCollection();
        $this->dispatcher = $this->call_dispatch($event, $listen);

        $routes = new \Symfox\Component\Collector\RouteCollection();
        $this->matcher = $this->call_match($routes);

        $db = $this->call_persistance(new \Symfox\Component\Collector\ConnCollection());
        $fn = $this->call_function(new \Symfox\Component\Collector\FnCollection());
        $this->controlProcessor = $this->call_control([$db, $fn->fn]);

        $this->argumentResolver = $this->call_argument();
    }

    /**
     * Returns instance of matcher component
     *
     * @param Symfox\Component\Collector\RouteCollection $routes
     * @return Symfony\Component\Routing\Matcher\UrlMatcher
     */
    private function call_match(\Symfox\Component\Collector\RouteCollection $routes)
    {
        $matchProcessor = new Match($routes);
        return $matchProcessor->getMatcher();
    }

    /**
     * Returns instance of dispatcher component
     *
     * @param Symfox\Component\Collector\EventCollection $events
     * @param Symfox\Component\Collector\ListenerCollection $listeners
     * @return Symfox\Component\Processor\Dispatch
     */
    private function call_dispatch(\Symfox\Component\Collector\EventCollection $events, \Symfox\Component\Collector\ListenerCollection $listeners)
    {
        $dispatchProcessor = new Dispatch($events, $listeners);
        return $dispatchProcessor;
    }

    /**
     * Returns instances of controller component
     *
     * @param array $arg
     * @return Symfox\Component\Processor\Control
     */
    private function call_control(array $arg)
    {
        $controlProcessor = new Control($arg);
        return $controlProcessor;
    }

    /**
     * Returns argument resolver instance 
     *
     * @return Symfony\Component\HttpKernel\Controller\ArgumentResolver
     */
    private function call_argument()
    {
        $argumentProcessor = new Argument();
        return $argumentProcessor->getResolver();
    }

    /**
     * Database persistence provider
     * Returns database manager instance of eloquent
     *
     * @param \Symfox\Component\Collector\ConnCollection $conn
     * @return Illuminate\Database\Capsule\Manager
     */
    private function call_persistance(\Symfox\Component\Collector\ConnCollection $conn)
    {
        $persistProcessor = new Persistance($conn);
        return $persistProcessor->getCapsule();
    }

    /**
     * Retrieve all custom functions defined
     *
     * @param \Symfox\Component\Collector\FnCollection $fn
     * @return \Symfox\Component\Collector\FnCollection
     */
    private function call_function(\Symfox\Component\Collector\FnCollection $fn)
    {
        return $fn;
    }

    private function process_view()
    {
        return new View();
    }

    private function process_session()
    {   
       return new Session();  
    }

    private function call_response()
    {   
       return new \Symfox\Component\Action\ResponseAction();  
    }

    public static function provide_component($name)
    {
        $action = "process_" . $name;

        if (method_exists(__CLASS__, $action)) {
            return self::$action();
        }
    }

    public static function call_component($name)
    {
        $action = "call_" . $name;

        if (method_exists(__CLASS__, $action)) {
            return self::$action();
        }
    }

}