<?php

// Register modules here
// 'Module_Full_Name' => [ active => true, parent => 'Parent_Module_Name' ]

return [
	'App_Main_Module' => [
		'active' => true,
		'parent' => false 
	],
	'App_Main_Module2' => [
		'active' => true,
		'parent' => 'App_Main_Module' 
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