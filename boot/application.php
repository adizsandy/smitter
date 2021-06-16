<?php

use Symfox\Foundation\Application;

$app = (new Application( dirname(__DIR__) ))->make();

return $app;