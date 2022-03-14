#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('DBFunctions.php');

//include('errors.php');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/db/git/rabbitmqphp_example/DB/Logs/errLog.txt');

//Database Server to Function and Message Type
function requestProcessor($request)
{
	echo "received request".PHP_EOL;
        echo $request['type'];
        var_dump($request);

        if(!isset($request['type']))
	{
            	return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type'])
	{
            	// Login
            	case "Login":
                	echo "<br>in login";
                	$response_msg = doLogin($request['username'],$request['password']);
                	break;

            	// Check Username Taken
            	case "CheckUsername":
                	echo "<br>in Checkusername";
                	$response_msg = checkUsername($request['username']);
                	echo "Result: " . $response_msg;
                	break;

            	// Check Email Taken
            	case "CheckEmail":
                	echo "<br>in CheckEmail";
                	$response_msg = checkEmail($request['email']);
                	break;

            	// Registration
            	case "Register":
                	echo "<br>in register";
                	$response_msg = register($request['username'], $request['email'], $request['password'], $request['firstname'], $request['lastname']);
                	break;

            	// User Profile
            	case "UserProfile":
                	$response_msg = userProfile($request['username']);
                	break;
	}
        echo $response_msg;
        return $response_msg;
}

// Create RabbitMQ Database Server
$server = new rabbitMQServer('DBRabbitMQ.ini', 'testServer');

echo "Database Server BEGIN\n";
// Process Client Request
$server->process_requests('requestProcessor');

?>
