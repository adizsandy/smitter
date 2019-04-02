<?php

namespace Symfox\Component\Processor;

use Illuminate\Database\Capsule\Manager as Capsule;

class Persistance{

	private $conn;
	private $db_type = "default";

	public function __construct($conn){
		$this->conn = $conn->conParam['database'][$this->db_type];
	}

	public function getCapsule(){
		$capsule = new Capsule();
		$capsule->addConnection($this->conn);
		$capsule->setAsGlobal();
		$capsule->bootEloquent();
		return $capsule;
	}

} 