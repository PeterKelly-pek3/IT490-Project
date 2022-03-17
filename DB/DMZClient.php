<?php

//include('errors.php');

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/testserver/git/rabbitmqphp_example/DB/Logs/errLog.txt');

function createDMZClient($request)
{
	$client = new rabbitMQClient("DMZRabbitMQ.ini","testServer");

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
