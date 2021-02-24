<?php

namespace App\Module\Api\Service;

use App\Module\Api\Order\Model\Order;
use Symfox\Persistance\Persistance;

class OrderScheduling {

	private $db;

	public function __construct() 
	{
		$this->db = new Persistance();
	}

}