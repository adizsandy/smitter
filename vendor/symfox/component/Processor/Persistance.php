<?php

namespace Symfox\Component\Processor;

use Illuminate\Database\Capsule\Manager as Capsule;
use Symfox\Component\Collector\Collector as MapCollector;

class Persistance{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn->conParam['database'][$this->getDBType($conn)];
	}

	public function getCapsule()
	{
		$capsule = new Capsule();
		$capsule->addConnection($this->conn);
		$capsule->setAsGlobal();
		$capsule->bootEloquent();
		return $capsule;
	}

	private function getDBType ($config) 
	{
		if ( isset ( $config->conParam['database'] ) && count( $config->conParam['database'] ) > 0 ) { 
			foreach ( $config->conParam['database'] as $name => $db_con ) {
				if ( $db_con['active'] == 'yes' ) { 
					return $name; 
					break;
				}
			}
		}
		
	}

} 