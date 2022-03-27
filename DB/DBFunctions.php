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

	   		$query = "INSERT INTO LeagueData VALUES ('$leaguename','$hometeam', '$awayteam', '$eventdate', '$eventID')";
	   		$result = $connection->query($query);
        	}
	}

	echo "Finished API Database Insert Query.\n";
	return false;
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
    
    return true;


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
	 		echo "GOOD FUCKING JOB DUMB FUCK";
	 		return true;
        
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
			echo "Player Fetched: ";
			echo gettype($fetch_player);
			print_r($fetch_player);
			
			
	
			if (is_null($resultplayer)) {
				echo "Not in a team";
			}
			
			elseif ($resultplayer == $username) {
				$select_group_name = "SELECT uname FROM CreateGroups WHERE code = '$singlegroupcode'"; 
				$result_group_name = $connection->query($select_group_name);
			
				echo "Team Name Selected";
			}
			
			else {
				echo "Result Player does not equal username";
			}
			
			
			
		}
		
		
		
		
	}
	
	echo $result_group_name;
	echo "Result returned to Front-End";
	return $result_group_name;
	
	
}
	 

?>

