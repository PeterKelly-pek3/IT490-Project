//This file is for testing our API connection

<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rmqClient.php');

//include('errors.php');

//Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/errLog.txt');

$request = array();

$request['type'] = "DMZTest";

$returnedValue = createDBClient($request);

echo $returnedValue;
return $returnedValue;

?>

