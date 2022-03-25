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
                	echo "Login\n";
                	$response_msg = doLogin($request['username'],$request['password']);
                	break;

            	// Check Username Taken
            	case "CheckUsername":
                	echo "Checkusername\n";
                	$response_msg = checkUsername($request['username']);
                	echo "Result: " . $response_msg;
                	break;

            	// Check Email Taken
            	case "CheckEmail":
                	echo "CheckEmail\n";
                	$response_msg = checkEmail($request['email']);
                	break;

            	// Registration
            	case "Register":
                	echo "Register\n";
                	$response_msg = register($request['username'], $request['email'], $request['password'], $request['firstname'], $request['lastname']);
                	break;

            	// User Profile
            	case "UserProfile":
			echo "Profile\n";
                	$response_msg = userProfile($request['username']);
                	break;

		// Test API Connection
		case "TestAPI":
			echo "TestAPI\n";
			$response_msg = getAPIConnection();
			break;
			
		//Create new user group
		case "groupsubmit":
    			echo "groupsubmit\n";
   	 		$response_msg = groupsubmit($request['groupname'], $request['groupkey']);
    			break;
			
		//Join user group
		case "groupjoin":
    			echo "groupjoin\n";
   		 	$response_msg = groupjoin($request['gkey'], $request['username']);
    			break;
			
		//Get historical stats
		case "getHistoricalStats":
			echo "getHistoricalStats\n";
			$response_msg = getHistoricalStats();
			break;
	}
	return $response_msg;
}

// Create RabbitMQ Database Server
$server = new rabbitMQServer('DBRabbitMQ.ini', 'testServer');

echo "Database Server BEGIN\n";
// Process Client Request
$server->process_requests('requestProcessor');

?>
