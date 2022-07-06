<?php
    
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('DBConnect.php');
require_once('DMZClient.php');

//include('errors.php');

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/db/git/rabbitmqphp_example/DB/Logs/errLog.txt');

//Login Function
function doLogin($username, $password)
{
	$connection = dbConnection();

        $query = "SELECT * FROM Users WHERE username = '$username'";
        $result = $connection->query($query);

	if($result)
	{
            	if($result->num_rows == 0)
		{
                	return false;
            	}
		else
		{
                	while ($row = $result->fetch_assoc())
			{
                    		$h_password = sha1($password);
                    		if ($row['h_password'] == $h_password)
				{
                        		return true;
                    		}
				else
				{
                        		return false;
                    		}
                	}
            	}
        }
}

// Query Function to Check if Username is Taken
function checkUsername($username)
{
        $connection = dbConnection();

        $check_username = "SELECT * FROM Users WHERE username = '$username'";
        $check_result = $connection->query($check_username);

        if($check_result)
	{
            	if($check_result->num_rows == 0)
		{
                	return true;
            	}
		elseif($check_result->num_rows == 1)
		{
                	return false;
                }
        }
}

// Query Function to Check if Email is Taken
function checkEmail($email)
{
        $connection = dbConnection();

        $check_email = "SELECT * FROM Users WHERE email = '$email'";
        $check_result = $connection->query($check_email);

        if($check_result)
	{
            	if($check_result->num_rows == 0)
		{
                	return true;
            	}
		elseif($check_result->num_rows == 1)
		{
                	return false;
                }
        }
}

// Query Function to Register New User
function register($username, $email, $password, $firstname, $lastname)
{
        $connection = dbConnection();

        $h_password = sha1($password);

        $newuser_query = "INSERT INTO Users VALUES ('$username', '$email', '$h_password', '$firstname', '$lastname')";
        $result = $connection->query($newuser_query);

        return true;
}

// Contact DMZ Server for API Test
function getAPIConnection()
{

	$request = array();

	$request['type'] = "GetAPI";
	echo "GetAPI Before Creating DMZ Client";
	$returnedValue = createDMZClient($request);
	var_dump($returnedValue);
	

	echo "Back from DMZ\n";
	//return $returnedValue;
	$connection = dbConnection();
	echo "DB Connection est.\n";

 	foreach($returnedValue['results'] as &$value)
	{
        	$LOL = $value['league']['name'];
        	$word = "LOL";
        	if(strpos($LOL, $word) !== false)
		{
            	//	echo "\n";
            	//	echo "League Name: ".$LOL"\n";
	    		$leaguename = $LOL;
            	//	echo "Home Team: ".$value['home']['name']"\n";
	    		$hometeam = $value['home']['name'];
            	//	echo "Away Team: ".$value['away']['name']"\n";
	    		$awayteam = $value['away']['name'];
            		$epoch = $value['time'];
            		$dt = new DateTime("@$epoch");
            	//	echo $dt->format('Y-m-d H:i:s')"\n";
	    		$eventdate = $dt->format('Y-m-d H:i:s');
            	//	echo "Event ID: ".$value['id']"\n";
	    		$eventID = $value['id'];
            	//	echo "\n";
				

	   		$query = "INSERT INTO LeagueData (leaguename, hometeam, awayteam, eventdate, eventID) VALUES ('$leaguename','$hometeam', '$awayteam', '$eventdate', '$eventID')";
			$result = $connection->query($query);
        	}
	}

	echo "Finished API Database Insert Query.\n";
	return false;
}
//get odds for upcoming matches
function getOdds()
{
	
	
	$connection = dbConnection();
	echo "DB Connection est.\n";
	$sql = "SELECT EventID FROM LeagueData";
	$result = $connection->query($sql);
	
	
	
	foreach ($result as $event) 
	{
		
		
		//print_r($event);
		$returnValue = create_odds_DMZ_Client($event);
		
		
		echo "returnValue:  ";
		echo print_r($returnValue);
		
		
		//$odds = $returnValue['results']['odds']['151_1'];
		//echo "Odds:  ";
		//var_dump($odds);
		
		$number = 1;
		
		foreach($returnValue['results']['odds']['151_'.$number] as $oddsvalue) 
		{
			//echo "INSIDE SECOND LOOP\n";
			$number++;
			$Home_Odds = $oddsvalue['home_od'];
			echo "Type Odds Home:  ";
			echo (gettype($Home_Odds));
			echo "Home Odds:  ";
			echo $Home_Odds;
			echo "\n";
			
			$Away_Odds = $oddsvalue['away_od'];
			echo "Type Odds Away:  ";
			print_r(gettype($Away_Odds));
			echo "Away Odds:  ";
			echo $Away_Odds;
			echo "\n";
			
			$strIDs = implode($event);
			$integerIDs = intval($strIDs);
			//print_r($event);
			//$event = $event[EventID];
			echo "IntegerIDs Type: ";
			print_r(gettype($integerIDs));
			echo "\n";
			echo "Integer ID:  ";
			print_r($integerIDs);
			//echo $event;
			
			$query = "UPDATE LeagueData SET Home_Odds='$Home_Odds', Away_Odds='$Away_Odds' WHERE eventID='$integerIDs'";
			//where eventID='$integerIDs' and Data2.reference_id=LeagueData.id a
			//$query = "INSERT INTO Data2 (Home_Odds, Away_Odds) VALUES ('$Away_Odds','$Home_Odds') WHERE eventID='$integerIDs' AND LeagueData.id=Data2.reference_id";
			$result = $connection->query($query);
			echo "Inserted into Query from GetOdds";
		}
		
		
	}
	
	echo "Finished API Databse Insert query for getOdds";
	
	
	
	
	
}

function create_odds_DMZ_Client($event)
{
	echo "GetOdds Before Creating DMZ Client";
	$request = array();
	echo "Request Array Created in create_odds_DMZ_Client Function";
	$request['type'] = "GetOdds";
	$request['eventID'] = $event;
	$returnedValue = createDMZClient($request);
	echo "Back from DMZ\n";
	echo "Returned to getOdds Function";
	return $returnedValue;
	
	//return $returnedValue;
}

// Contact DMZ Server for Historical Statistics
function getHistStats()
{

        $request = array();

        $request['type'] = "GetHistoricalStats";

        $returnedValue = createDMZClient($request);
        var_dump($returnedValue);

        echo "Back from DMZ\n";
        //return $returnedValue;
        $connection = dbConnection();
        echo "DB Connection est.\n";

	foreach($returnedValue as $value)
	{
        	foreach($value as $data)
		{
//            		echo "\n"; 
            		$Name = $data['Name'];
//            		echo "Name: ".$Name;
//            		echo "\n";
            		$Season = $data['Season'];
//            		echo "Season: ".$Season;
//            		echo "\n";
			$url = $data['url'];
//			echo "url: ".$url;
//			echo "\n";
            		$Region = $data['Region'];
//            		echo "Region: ".$Region;
//            		echo "\n";
            		$Games = $data['Games'];
//            		echo "Name: ".$Games;
//            		echo "\n";
            		$Win_rate = $data['Win_rate'];
			$dropDollar = rtrim($Win_rate, "$");
			$trimWin_rate = number_format($dropDollar, 2);
//            		echo "Win Rate: ".$Win_rate;
//            		echo "\n";
            		$KD = $data['KD'];
//            		echo "KD: ".$KD;
//            		echo "\n";
            		$GPM = $data['GPM'];
//            		echo "GPM: ".$GPM;
//            		echo "\n";
            		$GDM = $data['GDM'];
//            		echo "GDM: ".$GDM;
//            		echo "\n";

                        $query = "INSERT INTO HistoricalData (Name, Season, url, Region, Games, trimWin_rate, KD, GPM, GDM) VALUES ('$Name','$Season', '$url', '$Region', '$Games', '$trimWin_rate', '$KD', '$GPM', '$GDM')";
                        $result = $connection->query($query);
                }
        }

        echo "Finished API Database Historical Data Insert Query.\n";
	return false;
}

// Create User Groups

function groupsubmit($groupname, $groupkey)
{
	
    	$connection = dbConnection();
	echo "Connected to Database";
	

   
    	$newgroup_query = "INSERT INTO CreateGroups VALUES ('$groupname', '$groupkey')";
	echo "Query Created";
    	$result = $connection->query($newgroup_query);
	echo "INserted into Database";
	
	$result = $groupname." Group has been created with Group Key of: ".$groupkey;
    	return $result;
    
    


}

// Join Group
function groupjoin($gkey, $username){

    $connection = dbConnection();
    echo $username;
    
    $select_key_query = "SELECT code FROM CreateGroups";
    $result = $connection->query($select_key_query);
    foreach ($result as $value) {
	    foreach ($value as $data) {
		if ($data != $gkey) {
			echo "Key not matched";
	
	    	
    	        }
		else {
	 		$joingroup_query = "INSERT INTO CreateTeams (players, code) VALUES ('$username', '$gkey')";
    	 		$result = $connection->query($joingroup_query);
	 		echo "INSERTED INTO CreateTeams";
			$selectgroupname_query = "SELECT uname FROM CreateGroups WHERE code='$gkey'";
    	 		$result = $connection->query($selectgroupname_query);
			$fetch_teamname = mysqli_fetch_assoc($result);
			$uname = strval($fetch_teamname["uname"]);
	 		$result2 = $username." joined group: ".$uname;
    			return $result2;
        
    	    	}    
	    }
	   
    	   
     }
    
   
return false;		

    
}

//get historical stats to display on frontend
function getHistoricalStats(){
	
	$connection = dbConnection();
	$sql = "SELECT Name, Season, Region, trimWin_rate, KD, GPM, GDM FROM HistoricalData";
	$result = $connection->query($sql);
	$all_info = [];
	if ($result->num_rows > 0) {
	// output data of each row
		$num = 0;
		while($row = $result->fetch_assoc()) {
			$name = $row["Name"];
			echo $name;
			$season = $row["Season"];
			echo $season;
			$region = $row["Region"];
			echo $region;
			$trimWin_rate = $row["trimWin_rate"];
			$KD = $row["KD"];
			$GPM = $row["GPM"]; 
			$GDM = $row["GDM"];
			
			$team_stats = array("Name"=>$name, "Season"=>$season, "Region"=>$region, "trimWin_rate"=>$trimWin_rate, "KD"=>$KD, "GPM"=>$GPM, "GDM"=>$GDM);
			array_push($all_info, $team_stats);
			$num++;
		}
	echo print_r($all_info);
	return $all_info;
	} 
}	
	///else { echo "0 results"; }
	///$conn->close();

#Get the groups of players
function getGroups($username)
{
	$connection = dbConnection();
	
	echo $username;
	
	$group = 'SELECT code FROM CreateGroups';
	$resultgroup = $connection->query($group);
	foreach ($resultgroup as $groupcode) {
		foreach ($groupcode as $singlegroupcode) {
		

			$player = "SELECT players FROM CreateTeams WHERE code = '$singlegroupcode' AND players = '$username'";
			$resultplayer = $connection->query($player);
			
			echo "MYsqli Fetch.";
			
			$fetch_player = mysqli_fetch_assoc($resultplayer);
			echo "Fetch Player Array: ";
			print_r($fetch_player);
			echo "Player Fetched: ";
			echo $fetch_player["players"];
			
			
			
			
			
	
			if (is_null($resultplayer)) {
				echo "Not in a team";
			}
			
			elseif ($fetch_player["players"] == $username) {
				$select_group_name = "SELECT uname FROM CreateGroups WHERE code = '$singlegroupcode'"; 
				$result_group_name = $connection->query($select_group_name);
			
				echo "Team Name Selected";
				print_r($result_group_name);
				
				while($row = $result_group_name->fetch_assoc()) {
					$team_name = $row["uname"];
					echo $team_name;
					return $team_name;
				}
				
				echo "Result Returned to Front-End";
				break;
			}
			
			else {
				echo "Result Player does not equal username";
			}		
		}			
	}		
}

function chooseTeam($username, $teamname)
{
    $connection = dbConnection();
    $chooseTeam_query = "INSERT INTO RecruitTable (players, EsportsTeam) VALUES ('$username', '$teamname')";
    $connection->query($chooseTeam_query);

    $result = $teamname." Esports Team Recruited For ".$username;
    return $result;

}

function getRankings()
{
    $connection = dbConnection();
    $sql = "SELECT Name FROM HistoricalData ORDER BY trimWin_rate DESC";
    $result = $connection->query($sql);

    $all_info = [];
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $name = $row["Name"];
            echo $name;


            $team_rankings = array("Name"=>$name);
            array_push($all_info, $team_rankings);

        }
        echo print_r($all_info);
        return $all_info;
    }
 }
	 
function TeamToBetOn()
{
    $connection = dbConnection();
    $sql = "SELECT hometeam, awayteam, Home_Odds, Away_Odds FROM LeagueData";
    $result = $connection->query($sql);

    $all_info = [];
    if ($result->num_rows > 0) 
    {
        // output data of each row

        while($row = $result->fetch_assoc()) {
            $hometeam = $row["hometeam"];
            echo $hometeam;
	    $awayteam = $row["awayteam"];
            echo $awayteam;
	    $Home_Odds = $row["Home_Odds"];
            echo $Home_Odds;
	    $Away_Odds = $row["Away_Odds"];
            echo $Away_Odds;


            $betting_odds = array("hometeam"=>$hometeam, "awayteam"=>$awayteam, "Home_Odds"=>$Home_Odds, "Away_Odds"=>$Away_Odds);
            array_push($all_info, $betting_odds);

        }
        echo print_r($all_info);
        return $all_info;
     }
 }

function AddToBettingHistory($username, $hometeam, $awayteam, $teambet)
{
	$connection = dbConnection();
	$betDate = date('m/d/Y h:i:s a', time());
	echo strval($betDate);
    	$EnterBettingHistory_query = "INSERT INTO Betting_History (Username, Hometeam, Awayteam, teambet, betDate) VALUES ('$username', '$hometeam', '$awayteam', '$teambet', '$betDate')";
    	$connection->query($EnterBettingHistory_query);
	
	$result = $username." has placed a bet for ".$teambet." On ".$betDate;
    	return $result;
	
}

function ShowHistoryBets()
{
	$connection = dbConnection();
    	$sql = "SELECT Username, Hometeam, Awayteam, teambet, Won_or_Loss, Betting_Score, betDate FROM Betting_History";
    	$result = $connection->query($sql);
	
	$all_info = [];
	if ($result->num_rows > 0) {
        // output data of each row
       		while($row = $result->fetch_assoc()) {
            		$username = $row["Username"];
            		echo $username;
			$hometeam = $row["Hometeam"];
			echo $hometeam;
			$awayteam = $row["Awayteam"];
			echo $awayteam;
			$teambet = $row["teambet"];
			echo $teambet;
			$won_or_loss = $row["Won_or_Loss"];
			echo $won_or_loss;
			$bettingscore = $row["Betting_Score"];
			echo $bettingscore;
			$betDate = $row["betDate"];
			echo $betDate;
			


            		$bethistory = array("Username"=>$username, "Hometeam"=>$hometeam, "Awayteam"=>$awayteam, "teambet"=>$teambet, "Won_or_Loss"=>$won_or_loss, "Betting_Score"=>$bettingscore, "betDate"=>$betDate);
            		array_push($all_info, $bethistory);

        }
        echo print_r($all_info);
        return $all_info;
    }
}
?>

