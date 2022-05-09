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
#Getting the group values to display on the page.

#Should Leave this function here or add it to the DBFunctions file?
#'function getGroups()
#{
#	$group = array();
	
#	$player = array();
	
#	$group = 'SELECT groupname, groupkey FROM CreateGroups';
	
#	$player = 'SELECT username, gkey FROM CreateTeams';
	
#	$resultgroup = $connection->query($group);
  	
#	$resultplayer = $connection->query($player);
	
#	if(group[1] == player[1]){
#	return $resultgroup;
		
#	} 
#	else{
#		echo 'FUCK YOU, GOT NO FRIENDS OR BITCHES.';
#	}
#}'
#}

if (isset($_POST['getGroups']))
{
	$username = $_REQUEST['username'];
	$response = getGroups($username);
	echo($response);
	print_r($response);
}

if (isset($_POST['chooseTeam'])) {
    $teamname = $_REQUEST['team'];
    $response = chooseTeam($teamname);
    echo($response);
    print_r($response);
}

$response = getRankings();
echo($response);

$odds_response = TeamToBetOn();

if (is_null($odds_response)) 
{
	echo "<h5>Choose Team to Bet On</h5>"
	echo $odds_response;
	
}


?>


<DOCTYPE! html>
<head>
    <title>Current Groups</title>
</head>
<h2>Get Your Group</h2>
<form action="current_group.php" method="post">
    <h3>Show Group and Players</h3>
    <label for="username">Enter Username:</label><br/>
    <input id="username" name="username" type="text" value=""/>
    <p>
        <button type="submit" name="getGroups">Recruit Group</button>
    </p>
</form>
<h4>Choose Esports Team</h4>
<form action="current_group.php" method="post">
    <h5>Show Group and Players</h5>
    <label for="team">Enter Team Name:</label><br/>
    <input id="team" name="team" type="text" value=""/>
    <p>
        <button type="submit" name="chooseTeam">Choose Team</button>
    </p>
</form>
<h5>Show Top Winners</h5>
<button type="submit" name="chooseTeam">Show Rankings Based on Performance</button>
	


<body>


</body>
</html>
