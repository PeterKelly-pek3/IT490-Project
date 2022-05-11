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
	
	echo("<div class='card-body'><h5>".$response."</h5></div>");
	
	print_r($response);
}

if (isset($_POST['groupjoin']))
{
	$username = $_REQUEST['username'];
	$gkey = $_REQUEST['gkey'];
	$response = groupjoin($username, $gkey);
	
	echo("<div class='card-body'><h5>".$response."</h5></div>");
	
	print_r($response);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>League of Legends Fantasy League Profile</title>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
                <link href="css/dashboard/css/main.css" rel="stylesheet" media="all">
                <!-- Font special for pages-->
                <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style.css">
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
  
        <!--  User Profile start here -->  
        <div class="wrapper wrapper--w960" style="padding-bottom: 40px;padding-top: 10px;">
            <div class="card">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" style="text-align: center;">Create Your User Profile</h2>
                    <form method="post" action="profile.php">
			        <h3>User Profile</h3>
			        <div class="p-t-30" >
  	        		<button type="submit" class="btn4 btn btn--radius btn--green" name="test_api">Do NOT Click</button>
  			        </div>
  			        <p style="text-align: right;"><a href="logout.php?logout='1'" class="btn btn-outline-danger" style="color: red;">Logout</a></p>
		            </form> 
                    <form method="get" action="Esports_Chat/index.html">
                    <h3>User ProfileGlobal & Team Chat</h3>
                    <div class="p-t-30" >
                    <button type="submit" class="btn4 btn btn--radius btn--green" name="chat">Chat</button>
                    </div>
                    <p style="text-align: right;"><a href="logout.php?logout='1'" class="btn btn-outline-danger" style="color: red;">Logout</a></p>
                    </form>                   
                </div>
            </div>
        </div>
         <!--All User Profile end here -->
      
<!-- 
     
        <div class="wrapper wrapper--w960" style="padding-bottom: 40px;padding-top: 10px;">
            <div class="card">
                <div class="card-heading"></div>
                <div class="card-body">
                    <form method="get" action="Esports_Chat/index.html">
			<h3>User ProfileGlobal & Team Chat</h3>
			<div class="input-group" >
  	        		<button type="submit" class="btn4 btn btn--radius btn--green" name="chat">Chat</button>
  			</div>
  			<p><a href="logout.php?logout='1'" style="color: red;">Logout</a></p>
		</form>                    
                </div>
            </div>
        </div> -->


        <!-- Create Group start here -->  
        <div class="wrapper wrapper--w960" style="padding-bottom: 40px;padding-top: 10px;">
            <div class="card">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" style="text-align: center;">Create Group</h2>
                    <form method="post" action="profile.php">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Enter Group Name:</label>

                        <input id="groupname" name="groupname" type="text" value=""  class="form-control" >
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Create Group Key:</label>
                        <input id="groupkey" name="groupkey" type="text" value=""  class="form-control" >
                        </div>
                        
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit" name="create_group">Create Group</button>
                        </div>
                     </form>                    
                </div>
            </div>
        </div>
         <!--Create Group end here -->

        <!-- Join Group start here -->  
        <div class="wrapper wrapper--w960" style="padding-bottom: 40px;padding-top: 10px;">
            <div class="card">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" style="text-align: center;">Join Group</h2>
                    <form action="profile.php" method="post">
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Enter Username:</label>
                        <input id="username" name="username" type="text" value=""  class="form-control" >
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Enter Group Key:</label>
                        <input id="gkey" name="gkey" type="text" value=""  class="form-control" >
                        </div>
                        
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit" name="groupjoin">Join Group</button>
                        </div>
                     </form>                    
                </div>
            </div>
        </div>
         <!--Join Group end here -->
        <!-- Historical Data Stats start here -->  
        <div class="wrapper wrapper--w960" style="padding-bottom: 40px;padding-top: 10px;">
            <div class="card">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title" style="text-align: center;">Get Historical Data Stats</h2>
                    <form action="historical_data.php" method="post">
                        <div class="form-group">
                        <label  for="teamname">Enter Team Name:</label>
                        <input id="teamname" name="teamname" type="text" value=""  class="form-control" >
                        </div>
                        <div class="p-t-30">
                        <input type="submit" name ="Get_Stats" value="Get Team Stats" class="btn btn--radius btn--green" >
                        </div> 
                    </form>  
                    <h3 style="text-align: center;padding-top: 20px;">Group Hub<h3>
                        <form action="current_group.php" method="post">
                        <div class="p-t-30">
                        <input type="submit" name ="" value="Go To Group Hub" class="btn btn--radius btn--green" >
                        </div> 
                    </form>              
                </div>
            </div>
        </div>
         <!--Historical Data Stats end here -->	
		
	<!-- All Js -->
	<script type="text/javascript" src="webScripts.js">
	</script>

	</body>
</html>
