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
    $username = $_REQUEST['username'];
    $response = chooseTeam($username, $teamname);
    print_r($response);
}

if (isset($_POST['Get_Rankings'])) {
  
        $response = getRankings();
	$num = 1;
	foreach($response as $data) {
            
            echo "<br>";
            $Name = $data['Name'];
            echo $num." : ".$Name;
            echo "<br>";
	    $num++;
            
            
            
        }
            
    
   
}

if (isset($_POST['TeamToBetOn'])) {
	
	$odds_response = TeamToBetOn();
	foreach($odds_response as $data) {
            if (isset($data['Home_Odds'])) {
		    
		
            	echo "<br>";
            	$hometeam = $data['hometeam'];
            	echo "Home Team: ".$hometeam;
            	echo "<br>";
	    	$awayteam = $data['awayteam'];
            	echo "Away Team: ".$awayteam;
            	echo "<br>";
	    	$Home_Odds = $data['Home_Odds'];
            	echo "Home Odds: ".$Home_Odds;
            	echo "<br>";
	    	$Away_Odds = $data['Away_Odds'];
            	echo "Away Odds: ".$Away_Odds;
            	echo "<br>";
		
		echo "<h6>Choose Your Bet For This Match</h6>";
		echo "<form action='current_group.php' method='post'>";
		echo	"<button type='submit' name='postBet'>".$hometeam."</button>";
		echo "<br>";    
		echo	"<button type='submit' name='postBet'>".$awayteam."</button>";
		echo "<br>";   
            
	    }
            
        }
       
            
    
   
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
<h4>Recruit Your Esports Team</h4>
<form action="current_group.php" method="post">
    <h5>Show Group and Players</h5>
    <label for="team">Enter Team Name:</label><br/>
    <input id="team" name="team" type="text" value=""/>
    <label for="username">Enter Username:</label><br/>
    <input id="team" name="username" type="text" value=""/>
    <p>
        <button type="submit" name="chooseTeam">Choose Team</button>
    </p>
</form>
<h5>Show Top Winners</h5>
<form action="current_group.php" method="post">	
	<button type="submit" name="Get_Rankings">Show Rankings Based on Performance</button>
</form>	
	
<h6>Show Available Upcoming Games to Bet On</h6>
<form action="current_group.php" method="post">	
	<button type="submit" name="TeamToBetOn">Show Betting Odds for Upcoming Match</button>
</form>	

<h7>Show Wins/Losses (Betting History)</h7>
<form action="current_group.php" method="post">	
	<button type="submit" name="ShowHistoryBets">Show Betting Odds for Upcoming Match</button>
</form>	


<body>


</body>
</html>
