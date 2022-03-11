#!/usr/bin/php
<?php

session_start();

require_once('DBConnect.php');



$connection = dbConnect();

$sql="SELECT email FROM Users";
$result = $connection->query($sql);

while ($row = mysql_fetch_array($result, MYSQL_NUM))
{
  sendMail($row[0]);
}
mysql_free_result($result);

function sendMail($to)
{
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . '\r\n' .
    'Reply-To: webmaster@example.com' . '\r\n' .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
}

?>
