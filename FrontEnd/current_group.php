<?php


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
#Getting the group values to display on the page.
function getGroups()
{
	$group = array();
	
	$player = array();
	
	$group = 'SELECT groupname, groupkey FROM CreateGroups';
	
	$player = 'SELECT username, gkey FROM CreateTeams';
	
	$resultgroup = $connection->query($group);
  	
	$resultplayer = $connection->query($player);
	
	if(group[1] == player[1]){
	return $resultgroup;
		
	} 
	else{
		echo 'FUCK YOU, GOT NO FRIENDS OR BITCHES.';
	}
}
}
?>


<DOCTYPE! html>
 <head>
  <title>Current Groups</title>
 </head>
  <h2>This is the groups that are avaible.</h2>
 <body>
 <?php echo getGroups();  ?>
 </body>
</html>
