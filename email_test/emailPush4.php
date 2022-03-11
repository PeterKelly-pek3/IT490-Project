#!/usr/bin/php
<?php
   $to = "pek3@njit.edu";
   $subject = "Subject for the email";
   $body = "Hi test person, This is test email.";
   $header = "From: from@email";
 
   if ( mail($to, $subject, $body, $header)) {
      echo("Success");
   } else {
      echo("Failed");
   }
?>
