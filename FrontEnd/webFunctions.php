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

//include('errors.php');

// RabbitMQ Client to Database for Login
function login($username, $password)
{
	$request = array();

        $request['type'] = "Login";
        $request['username'] = $username;
        $request['password'] = $password;

        $returnedValue = createClientForDb($request);

        if($returnedValue == 1)
	{
            	$_SESSION["username"] = $username;
            	$_SESSION["logged"] = true;
        }
	else
	{
            	session_destroy();
        }

        return $returnedValue;
}

// RabbitMQ Client to Database for Registration
function register($firstname, $lastname, $username, $email, $password)
{

        $request = array();

        $request['type'] = "Register";
        $request['username'] = $username;
        $request['password'] = $password;
        $request['firstname'] = $firstname;
        $request['lastname'] = $lastname;
        $request['email'] = $email;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
}

// RabbitMQ to Check if Username Exists
function usernameVerification($username)
{

        $request = array();

        $request['type'] = "CheckUsername";
        $request['username'] = $username;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
}

// RabbitMQ to Check if Email Exists
function emailVerification($email)
{

        $request = array();

        $request['type'] = "CheckUsername";
        $request['email'] = $email;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
}

// RabbitMQ to Test API through Database and DMZ
if (isset($_POST['test_api']))
{
	$request = array();

	$request['type'] = "TestAPI";

	$returnedValue = createClientForDb();

	return $returnedValue;
}

// Create User Groups
if (isset($_POST['create_group']))
{
	$request = array();

	$request['type] = "CreateGroup";

	$returnedValue = createClientForDb($request);


}

?>
