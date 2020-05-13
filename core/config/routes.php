<?php

// ......... Register routes from here
return [

	'home' => [ '/' , 'HomeController::index' ],
	'number_game' => [ '/number_game/{number}' , 'HomeController::numberGame' ]
];
// ........ 

