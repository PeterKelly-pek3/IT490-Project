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


if (isset($_POST['HomeTeamBet'])) {
	
	$username = $_REQUEST['username'];
	$hometeam = $_REQUEST['hometeam'];
	$awayteam = $_REQUEST['awayteam'];
	$teambet = $hometeam;
	$response = AddtoBettingHistory($username, $hometeam, $awayteam, $teambet);
	echo $response;
	
}

if (isset($_POST['AwayTeamBet'])) {
	
	$username = $_REQUEST['username'];
	$hometeam = $_REQUEST['hometeam'];
	$awayteam = $_REQUEST['awayteam'];
	$teambet = $awayteam;
	$response = AddtoBettingHistory($username, $hometeam, $awayteam, $teambet);
	echo $response;
	
}

if (isset($_POST['ShowHistoryBets'])) {
	
	
	$response = ShowHistoryBets();
	foreach($response as $data) {
            
            echo "<br>";
            $username = $data['Username'];
            echo "Username: ".$username;
            echo "<br>";
	    $hometeam = $data['Hometeam'];
	    $awayteam = $data['Awayteam'];
            echo "Match: ".$hometeam." VS ".$awayteam;
            echo "<br>";
	    $teambet = $data['teambet'];
	    $betDate = $data['betDate'];
            echo "Bet Placed For Team ".$teambet." On ".$betDate;
            echo "<br>";
	    $bettingscore = $data['Betting_Score'];
	    echo "Amount of Bets Won By ".$username." : ".$bettingscore;
	    echo "<br>";
	    echo "<br>";
		
	    
            
            
            
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
		echo "<label for='username'>Enter Username:</label><br/>";
		echo "<br>";
		echo "<input id='username' name='username' type='text' value=''/>";
		echo " <input type='hidden' id='hometeam' name='hometeam' value='".$hometeam."'>";
		echo " <input type='hidden' id='awayteam' name='awayteam' value='".$awayteam."'>";
		echo " <button type='submit' name='HomeTeamBet'>".$hometeam."</button>";
		echo "</form>";
		echo "<br>";  
		echo "<form action='current_group.php' method='post'>";
		echo "<label for='username'>Enter Username:</label><br/>";
		echo "<br>";
		echo "<input id='username' name='username' type='text' value=''/>";
		echo " <input type='hidden' id='hometeam' name='hometeam' value='".$hometeam."'>";
		echo " <input type='hidden' id='awayteam' name='awayteam' value='".$awayteam."'>";
		echo	"<button type='submit' name='AwayTeamBet'>".$awayteam."</button>";
		echo "</form>";
		echo "<br>";   
            
	    }
            
        }
       
      
}


?>
<DOCTYPE! html>
 <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Current Groups</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dashboard/css/main.css" rel="stylesheet" media="all">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        
 </head>
    <body style="background-color: #222D32;">    
     <!-- Nav Start here -->
      <nav class="navbar navbar-dark bg-dark navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" style="width: 100%;" href="#">League of Legends Fantasy League</a>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav  ">
                    <!-- <li class="nav-item" >
                        <a class="nav-link " href="#"></a>
                    </li> -->
                    

                </ul>
                   <ul class="navbar-nav  ml-auto">
                    <li class="nav-item" >
                        <a class="nav-link " href="logout.php?logout='1'">Logout</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav> 
     <!-- Nav end here -->
  
        <!-- Group and Players Stats start here -->  
        <div class="wrapper wrapper--w960" style="padding-bottom: 40px;padding-top: 10px;">
            <div class="card">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" style="text-align: center;">This is the groups that are avaible</h2>
                    <form action="current_group.php" method="post">
                        <h3>Show Group and Players</h3>
                        <div class="form-group">
                        <label for="username">Enter Username:</label>
                        <input id="username" name="username" type="text" value=""  class="form-control" >
                        </div>
                        <div class="p-t-30">
                            <p><button type="submit" name="getGroups" class="btn btn--radius btn--green">Recruit Group</button></p>
                        </div> 
                    </form>            
                </div>
            </div>
        </div>
         <!--Group and Players Stats end here -->   
     <!-- Group and Players 2nd start here -->  
        <div class="wrapper wrapper--w960" style="padding-bottom: 40px;padding-top: 10px;">
            <div class="card">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" style="text-align: center;">This is the groups that are avaible</h2>
                    <form action="current_group.php" method="post">
                        <h3>Show Group and Players</h3>
                        <div class="form-group">
                        <label for="team">Enter Team Name:</label>
                        <input id="team" name="team" type="text" value=""  class="form-control" >
                        </div>
                        <div class="p-t-30">
                            <p><button type="submit" name="chooseTeam" class="btn btn--radius btn--green">Choose Team</button></p>
                        </div> 
                    </form>            
                </div>
            </div>
        </div>
         <div class="wrapper wrapper--w960" style="padding-bottom: 40px;padding-top: 10px;">
            <div class="card">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" style="text-align: center;"></h2>
                        <div class="p-t-30">
                            <p><button type="submit" name="chooseTeam" class="btn btn--radius btn--green">Show Rankings Based on Performance</button></p>
                        </div> 
                    </form>            
                </div>
            </div>
        </div>
         <!--Group and Players 2nd end here -->  
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
    <!-- All Js -->
    <script type="text/javascript" src="webScripts.js">
    </script>

</body>

</html>
