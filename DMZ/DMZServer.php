#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('DMZFunctions.php');
//require_once('testAPI.php');

// DMZ Server to Function
function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];

        var_dump($request);

        if(!isset($request['type']))
	{
            	return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type'])
	{
            	// TEST API
            	case "TestAPI":
                	$response_msg = someFunction($request['testapi']);
                	break;
        }
       	echo var_dump($response_msg);
        return $response_msg;
    }

// Create RabbitMQ DMZ Server
$server = new rabbitMQServer('DMZRabbitMQ.ini', 'testServer');

echo("DMZ Server BEGIN\n");
$server->process_requests('requestProcessor');

?>