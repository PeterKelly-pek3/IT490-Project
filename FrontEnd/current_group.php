<?php

session_start();

//Check login and redirect
//if (!$_SESSION["logged"])
//{
//	header("Location: /loginRegister.html");
//}


include('webClient.php');
include('webFunctions.php');
//include('errors.php');


//Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/errLog.txt');

function getGroupName()
{
	$request = array();

  $groupname = $_REQUEST['groupname'];

	return $groupname[0];
	
}
?>


<DOCTYPE! html>
 <head>
  <title>Current Group</title>
 </head>
  <h2>This is the group you are a part of.</h2>
 <body>
 <?php echo getGroupName();  ?>
 </body>
</html>
