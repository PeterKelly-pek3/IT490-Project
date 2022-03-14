#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/errLog.txt');

//Read local log files
$file = file_get_contents("/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/errLog.txt");

$errArray = [];

$request = array();
$request['type'] = "rmq";
$request['error_string'] = $file;

$returnedValue = createRMQClient2($request);


//file_put_contents("/home/testserver/git/rabbitmqphp_example/Logs/errLog.txt", "");

function createRMQClient2($request)
{
        $client = new rabbitMQClient('ErrorRabbitMQ2.ini','testServer');

        if(isset($argv[1]))
        {
                $msg = $argv[1];
        }
        else
        {
                $msg = "client";
        }

        $response = $client->send_request($request);
        return $response;
}
file_put_contents("/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/eventLog.txt", $returnedValue, FILE_APPEND);
?>

