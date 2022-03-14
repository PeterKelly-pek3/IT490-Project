<?php

//include('errors.php');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/db/git/rabbitmqphp_example/DB/Logs/errLog.txt');

// Connect to Database
function dbConnection()
{
	// Server and User Information
	$hostname  = "127.0.0.1";
	$username  = "peter";
	$password  = "Password12345$";
	$dbname    = "Gambling_DB";

	$conn = mysqli_connect($hostname, $username, $password, $dbname);

	if (!$conn)
	{
		echo "***Error connecting to database!!*** ".$conn->connect_errno.PHP_EOL;
		exit(1);
	}
	return $conn;
}
?>
