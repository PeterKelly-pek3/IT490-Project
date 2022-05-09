<?php

session_start();
print_r($_SESSION);

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

if (isset($_POST['create_group']))
{
	$username = $_REQUEST['groupname'];
	$gkey = $_REQUEST['groupkey'];
	$response = create_group($username, $gkey);
	echo($response);
	print_r($response);
}

if (isset($_POST['groupjoin']))
{
	$username = $_REQUEST['username'];
	$gkey = $_REQUEST['gkey'];
	$response = groupjoin($username, $gkey);
	echo($response);
	print_r($response);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>League of Legends Fantasy League Profile</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h2>Create Your User Profile</h2>
		<form method="post" action="profile.php">
			<h3>User Profile</h3>
			<div class="input-group">

  	        		<button type="submit" class="btn4" name="test_api">Do NOT Click</button>
  			</div>
  			<p><a href="logout.php?logout='1'" style="color: red;">Logout</a></p>
		</form>

		<form method="get" action="Esports_Chat/index.html">
                        <h3>Global & Team Chat</h3>
                        <div class="input-group">

                                <button type="submit" class="btn4" name="chat">Chat</button>
                        </div>
                        <p><a href="logout.php?logout='1'" style="color: red;">Logout</a></p>
                </form>
				
		<h4>Create Group</h4>
			<form action="profile.php" method="post">
    			<label for="groupname">Enter Group Name:</label><br />
    			<input id="groupname" name="groupname" type="text" value="" /><br />
    			<label for="groupkey">Create Group Key:</label><br />
    			<input id="groupkey" name="groupkey" type="text" value="" /><br /><br />
    			<button type="submit" name="create_group">Create Group</button>
			</form>

		
		<form action="profile.php" method="post">
				
    		<h5>Join Group</h5>
			<label for="username">Enter Username:</label><br />
    			<input id="username" name="username" type="text" value="" />
    			<label for="gkey">Enter Group Key:</label><br />
    			<input id="gkey" name="gkey" type="text" value="" />
    			<p><button type="submit" name="groupjoin">Join Group</button></p>
			</form>
			
		<h6>Get Historical Data Stats<h6>
			<form action="historical_data.php" method="post">
				<label for="teamname">Enter Team Name:</label><br />
    				<input id="teamname" name="teamname" type="text" value="" /><br />
    				<input type="submit" name ="Get_Stats" value="Get Team Stats" />
			</form>
		
		<h7>Group Hub<h7>
			<form action="current_group.php" method="post">
    				<input type="submit" name ="" value="Go To Group Hub" />
			</form>
	<script type="text/javascript" src="webScripts.js">
	</script>

	</body>
</html>
