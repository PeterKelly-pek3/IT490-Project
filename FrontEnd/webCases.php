<?php

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/errLog.txt');

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('webClient.php');

include('webFunctions.php');
//include('errors.php');

session_start();

// Declare and GET type
$type = $_GET["type"];

	// Check type of Message Request
    	switch ($type)
	{
        	case "Login":
			$username = $_GET["username"];
            		$password = $_GET["password"];

            		$response = login($username, $password);
            		echo $response;
            		break;

        	case "RegisterNewUser":
            		$firstname = $_GET["firstname"];
            		$lastname = $_GET["lastname"];
            		$username = $_GET["username"];
            		$email = $_GET["email"];
            		$password = $_GET["password"];

            		$response = register($firstname, $lastname, $username, $email, $password);
            		echo $response;
            		break;

        	case "UsernameVerification":
            		$username = $_GET["username"];

            		$response = usernameVerification($username);
            		echo $response;
            		break;

        	case "EmailVerification":
            		$email = $_GET["email"];

            		$response = emailVerification($email);
            		echo $response;
            		break;

        	default:
            		return "No message supported.";
	}

?>
