<?php

// MODULE DECLARATION FILE
return [

    // Unique Standard Name of the module
    // Must match with the registered name 
    'name' => 'Main_Module',

    // Author of the given module
    'author' => 'Shudhansh Dubey',

    // Version of the module to keep track of developments
    'version' => '1.0.0', // Module version

    // define common prefix for all request paths
    'url_prefix' => '/', 

    // State for given module is required or not, REST API or Non-API 
    // By default it will be considered as false/Non-API
    'stateless' => false 

];
