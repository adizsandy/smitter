<?php

// Register modules here
// 'Module_Full_Name' => [ active => true, parent => 'Parent_Module_Name' ]

return [
	'App_Default_Module' => [
		'active' => true,
		'parent' => false 
	],
	'App_Default_Module2' => [
		'active' => true,
		'parent' => 'App_Default_Module' 
	],
	'App_Default_Module3' => [
		'active' => true,
		'parent' => 'App_Default_Module2' 
	],
	'App_Shashank_ERP01' => [
		'active' => true,
		'parent' => false 
	],
	'App_Shashank_ERP02' => [
		'active' => true,
		'parent' => false 
	]
];