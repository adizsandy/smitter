<?php

return [
    'driver' => $_SERVER['MAIL_DRIVER'],
    'host' => $_SERVER['MAIL_HOST'],
    'port' => $_SERVER['MAIL_PORT'],
    'username' => $_SERVER['MAIL_USERNAME'],
    'password' => $_SERVER['MAIL_PASSWORD'],
    'encryption' => $_SERVER['MAIL_ENCRYPTION']
];