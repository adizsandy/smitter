<?php

namespace Symfox\Persistance;

use App\Registry;
use Illuminate\Database\Capsule\Manager as Capsule; 

class Persistance {

	protected $conn;
	protected $persistance;

	public function __construct()
	{ 	
		$this->setConnection();
		$this->setPersistance();

		return $this->getPersistance();
	}

	protected function setConnection() 
	{	 
		$this->conn = (new Registry)->getConnection();
	}

	protected function getConnection() 
	{
		return $this->conn;
	}

	protected function setPersistance()
	{ 	
		$capsule = new Capsule();
		$capsule->addConnection($this->getConnection()); 
		$capsule->bootEloquent();
		$this->persistance = $capsule->getDatabaseManager();
	}

	public function getPersistance() 
	{
		return $this->persistance;
	}

} 