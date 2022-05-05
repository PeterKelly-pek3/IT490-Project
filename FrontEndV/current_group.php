<?php
session_start();

//Check login and redirect
//if (!$_SESSION["logged"])
//{
//	header("Location: login.html");
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
		
	<!-- All Js -->
	<script type="text/javascript" src="webScripts.js">
	</script>

</body>

</html>
