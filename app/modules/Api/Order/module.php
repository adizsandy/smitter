<?php

return [

    'declarations' => [
        'name' => 'App_Api_Order',
        'author' => 'Shudhansh Dubey',
        'url_prefix' => '/api/v2/order/'
    ],

    'routes' => [ 
        'post_create_order' => [ '/', 'OrderController::create' ], 
        'post_update_order' => [ '/update', 'OrderController::update' ], 
        'post_delete_order' => [ '/delete', 'OrderController::delete' ], 
        'get_fetch_order' => [ '/{order_id}', 'OrderController::fetch' ], 
    ]

];