<?php

namespace Symfox\Component\Processor;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Persistanc{

	private $conn;
	private $path;
	private $config;
	private $isDevMode = true;
	private $db_type = "default";

	public function __construct($path, $conn){
		$this->config = $this->getConfig($path, $this->isDevMode);
		$this->conn = $conn->conParam['database'][$this->db_type];
	}

	public function getEntityManager(){
		return EntityManager::create($this->conn, $this->config);
	}

	protected function getConfig($path, $isDevMode){
		return Setup::createAnnotationMetadataConfiguration($path->paths, $isDevMode);
	}
} 