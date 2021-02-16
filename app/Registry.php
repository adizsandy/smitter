<?php

namespace App;

class Registry {

    protected $connection;

    public function __construct()
    {
        $this->setConnection();
    }

    private function setConnection() 
    {
        // Set Database connection
        $app_config = require __DIR__. '/../config/app.php';
        $this->connection = $app_config['database'];
    }

    public function getConnection() 
    {
        return $this->connection;
    }
}