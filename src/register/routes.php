<?php

// ......... Define routes from here
return [

	'home' => [ '/' , 'HomeController::index' ],

	'number_game' => [ '/number_game/{number}' , 'HomeController::numberGame' ]
];

// ........ End route definitions

