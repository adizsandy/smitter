<?php

namespace Symfox\Persistance;

use Boot\Env\Configurator;
use Symfox\Persistance\Persistance;

class PersistanceFactory {

    private $connection;

    public function __construct(string $connection = 'default')
    {
        // Set Connection
        $this->setConnection($connection);
    }

    public function getPersistance() 
    {
        return ( new Persistance($this->connection) )->getPersistance();
    }

    public function connection($connection_name = 'default') 
	{
		$this->setConnection($connection_name); 
		return $this;
	}

    protected function setConnection($connection) 
    {
        $this->connection = Configurator::getConnectionDetails($connection);
    } 
}