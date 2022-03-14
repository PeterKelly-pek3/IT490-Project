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

// Contact DMZ Functions

?>
