#!/usr/bin/php
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//session_start();
//include_once('../class.phpmailer.php');

require_once('DBConnect.php');
require_once('PHPMailer/PHPMailerAutoload.php');
require_once('vendor/autoload.php');

$connection = dbConnect();

$sql="SELECT email FROM Users";
$result = $connection->query($sql);


//$query = "SELECT * FROM mail_list"; 	 
//$result = mysql_query($query) or exit(mysql_error());
$numplayers = mysql_numrows($result) or exit(mysql_error());
// confirm and subject line variables
//$confirm = $_POST['confirm'];
$subjectline = "Doing it Live!";
$i=1;
//if ($confirm == TRUE)
//	{
	while ($i<=mysql_num_rows($result))
		{
		$row = mysql_fetch_array($result) or exit(mysql_error());	
		$to = $row['email'];
		$subject = "$subjectline";
		$body = "HTML FOR NEWSLETTER";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: From Name <fromemail@domain.com>' . "\r\n";
		if (mail($to, $subject, $body, $headers))
		{
			echo("<p>Message successfully sent! $to </p>");
		}
		else
		{
			echo("<p>Message delivery failed... $to </p>");
		}
		$i++;
		}
		// while loop finished
		echo "<br/>";
		$i--; // decrements once to reflect accurate count and displays number of emails sent out
		echo "Newsletter has been sent $i times.";	
//} else {
//echo "<br/>Newsletter Not Sent<br/><br/>";

?>
