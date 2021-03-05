<?php

function container() 
{
    global $kernel;
	$container = $kernel->getContainer();
    return $container;
}

function db() 
{
    return container()->get('db');
}

function response() 
{
    return container()->get('response');
}

function auth() 
{
    return container()->get('auth');
}

function session() 
{
    return ( container()->get('session') )->getSession();
}

function filehandler() 
{
    return ( container()->get('filehandler') )->getHandler();
}

function mailer() 
{
    return ( container()->get('mailer') )->getMailer();
}

function cache() 
{
    return container()->get('cache');
}

function view() 
{
    return container()->get('view');
}

function request() 
{
    return container()->get('request');
}