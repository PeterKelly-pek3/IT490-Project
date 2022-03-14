#!/usr/bin/php
<?php

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', 'home/dmz/git/rabbitmqphp_example/DMZ/Logs/errLog.txt');

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

// Function to check Error Message Type
function requestProcessor($request)
{
        echo "received request".PHP_EOL;
        echo $request['type'];

        //  This will show all the requests comming in
        var_dump($request);

        if(!isset($request['type']))
        {
                return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type'])
        {
           	case "rmq":
                	echo "RMQ Errors: ";
                	$response_msg = file_put_contents('Logs/RMQLog.txt',$request['error_string'], FILE_APPEND);
                	$dist_msg = file_get_contents('Logs/RMQLog.txt');
                	break;

            	case "frontend":
                	echo "Frontend Errors: ";
                	$response_msg = file_put_contents('Logs/FrontEndLog.txt',$request['error_string'], FILE_APPEND);
                	$dist_msg = file_get_contents('Logs/FrontEndLog.txt');
                	break;

            	case "dmz":
                	echo "DMZ Errors: ";
                	$response_msg = file_put_contents('Logs/DMZLog.txt',$request['error_string'], FILE_APPEND);
                	$dist_msg = file_get_contents('Logs/DMZLog.txt');
                	echo "Result: " . $response_msg;
                	break;

            	case "db":
                	echo "Database Errors: ";
                	$response_msg = file_put_contents('Logs/DatabaseLog.txt',$request['error_string'], FILE_APPEND);
                	$dist_msg = file_get_contents('Logs/DatabaseLog.txt');
                	echo "Result: " . $response_msg;
                	break;
        }
        echo $response_msg;
        return $dist_msg;
}

//Create RabbitMQServer
$server = new rabbitMQServer('ErrorRabbitMQ4.ini', 'testServer');

echo("DMZ Error Server BEGIN\n");
$server->process_requests('requestProcessor');

?>

