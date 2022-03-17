<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//include('errors.php');

//Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/dmz/git/rabbitmqphp_example/DMZ/Logs/errLog.txt');

//Test API Function
function someFunction()
{

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.b365api.com/v3/events/upcoming?sport_id=151&token=115215-MDpRLi6nUUlglr",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",

]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err)
{
    	echo "cURL Error #:" . $err;
}
else
{
    	$data = json_decode($response, true);
	$sendData = $data;
	return $sendData;

}
}

// Get historical data function
function getHistorical()
{
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://www.parsehub.com/api/v2/runs/tVTojL79cxRB/data?api_key=tcsVdAnoG3uW&format=json",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",

]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err)
{
    	echo "cURL Error #:" . $err;
}
else
{
    	$data = json_decode($response, true);
	$sendData = $data;
        return $sendData;
}
}
?>
