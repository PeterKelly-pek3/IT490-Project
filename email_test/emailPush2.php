#!/usr/bin/php
<?php

session_start();

require_once('DBConnect.php');



$connection = dbConnect();

$sql="SELECT email FROM Users";
$result = $connection->query($sql);

$recordset = mysql_query($result);
$row_recordset = mysql_fetch_assoc($recordset);
$tota_row_recordset = mysql_num_rows($recordset);
$msg = strip_tags($_POST['msg']);
$mail= new PHPMailer();
while($row = mysql_fetch_array($recordset))
{
    $to = $row['email'];
    $mail->AddAddress($to, "Test Message"); 
}      
$mail->IsSMTP();    
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";     
$mail->Port = 465;      
$mail->CharSet = "big5";
$mail->Subject = "Test Message";     
$mail->Username = "xxxxxx";    
$mail->Password = "xxxxxx";   
$mail->Body = "$msg";
$mail->IsHTML(true);           
if(!$mail->Send()) {      
echo "Mailer Error: " . $mail->ErrorInfo;       
} else {      
//header('Location: index.php');
}
?>

