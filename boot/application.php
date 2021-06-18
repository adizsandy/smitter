<?php

use Symfox\Foundation\Application;

// Create a new instance and return application container
$app = (new Application( dirname(__DIR__) ))->make();

return $app;