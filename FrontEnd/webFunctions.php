<?php

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/errLog.txt');

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('webClient.php');

//include('errors.php');

// RabbitMQ Client to Database for Login
function login($username, $password)
{
	$request = array();

        $request['type'] = "Login";
        $request['username'] = $username;
        $request['password'] = $password;

        $returnedValue = createClientForDb($request);

        if($returnedValue == 1)
	{
            	$_SESSION["username"] = $username;
            	$_SESSION["logged"] = true;
        }
	else
	{
            	session_destroy();
        }

        return $returnedValue;
}

// RabbitMQ Client to Database for Registration
function register($firstname, $lastname, $username, $email, $password)
{

        $request = array();

        $request['type'] = "Register";
        $request['username'] = $username;
        $request['password'] = $password;
        $request['firstname'] = $firstname;
        $request['lastname'] = $lastname;
        $request['email'] = $email;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
}

// RabbitMQ to Check if Username Exists
function usernameVerification($username)
{

        $request = array();

        $request['type'] = "CheckUsername";
        $request['username'] = $username;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
}

// RabbitMQ to Check if Email Exists
function emailVerification($email)
{

        $request = array();

        $request['type'] = "CheckUsername";
        $request['email'] = $email;

        $returnedValue = createClientForDb($request);

        return $returnedValue;
}

// RabbitMQ to Test API through Database and DMZ
if (isset($_POST['test_api']))
{
	$request = array();

	$request['type'] = "TestAPI";

	$returnedValue = createClientForDb();

	return $returnedValue;
}

// Create User Groups

function create_group($groupname, $groupkey)
{
	$request = array();

	$request['type'] = "groupsubmit";
	$groupname = $_REQUEST['groupname'];
	$request['groupname'] = $groupname;
	$groupkey = $_REQUEST['groupkey'];
	$request['groupkey'] = $groupkey;
	

	$returnedValue = createClientForDb($request);

	return $returnedValue;

}
// Join User Groups
function groupjoin($username, $gkey)
{
    $request = array();

    $request['type'] = "groupjoin";
    $gkey = $_REQUEST['gkey'];
    $request['gkey'] = $gkey;
    $username = $_REQUEST['username'];
    $request['username'] = $username;


    $returnedValue = createClientForDb($request);

    return $returnedValue;
}


// Recruit A team
if (isset($_POST['RecruitTeam']))
{
    $request = array();

    $request['type'] = "RecruitTeam";
    $gkey = $_REQUEST['Ename'];
    $request['gteam'] = Ename;
    $username = $_REQUEST['username'];
    $request['username'] = $username;


    $returnedValue = createClientForDb($request);

    return $returnedValue;
}


//Get historical stats to display in front end
function getHistoricalStats()
{
	$request = array();

	$request['type'] = "getHistoricalStats";

	$returnedValue = createClientForDb($request);

	return $returnedValue;
	
}
#Get current groups for the player 
function getGroups($username)
{
	$request = array();
	
	$request['type'] = "getGroups";
	
        $request['username'] = $username;
	
	$returnedValue = createClientForDb($request);
	
	return $returnedValue;
	
	
}

function chooseTeam($username, $teamname)
{
    $request = array();

    $request['type'] = "chooseTeam";

    $request['teamname'] = $teamname;
    $request['username'] = $username;

    $returnedValue = createClientForDb($request);

    return $returnedValue;


}
function getRankings()
{
    $request = array();

    $request['type'] = "getRankings";

    $returnedValue = createClientForDb($request);

    return $returnedValue;


}

function TeamToBetOn()
{
    $request = array();

    $request['type'] = "TeamToBetOn";

    $returnedValue = createClientForDb($request);

    return $returnedValue;


}
?>
