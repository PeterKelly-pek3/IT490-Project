<?php

session_start();

include('webClient.php');
include('webFunctions.php');
//include('errors.php');


//Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/errLog.txt');
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

  	        		<button type="submit" class="btn4" name="create_profile">Do NOT Click</button>
  			</div>
  			<p><a href="logout.php?logout='1'" style="color: red;">Logout</a></p>
		</form>

		<form method="get" action="Esports_Chat/index.html">
                        <h3>Global & Team Chat</h3>
                        <div class="input-group">

                                <button type="submit" class="btn4" name="chat">Chat</button>
                        </div>
                        <p><a href="logout.php?logout='1'" style="color: red;">Logout>
                </form>
				
		<h4>Create Group</h4>
			<form action="webFunctions.php" method="post">
    			<label for="groupname">Enter Group Name:</label><br />
    			<input id="groupname" name="groupname" type="text" value="" /><br />
    			<label for="groupkey">Create Group Key:</label><br />
    			<input id="groupkey" name="groupkey" type="text" value="" /><br /><br />
    			<button type="submit" name="groupsubmit">Create Group</button>
		</form>

		<form action="webFunctions.php" method="post">
    			<h5>Join Group</h5>
   			<p><label for="group">Choose Group:</label></p>

    			<select id="group" name="group">
        		<option value="group1">Group1</option>
        		<option value="group2">Group2</option>
    			</select>
    			<br />
    			<label for="gkey">Enter Group Key:</label><br />
    			<input id="gkey" name="gkey" type="text" value="" />
    			<p><button type="submit" name="groupjoin">Join Group</button></p>
		</form>
			
	<script type="text/javascript" src="webScripts.js">
	</script>
	</body>
</html>
