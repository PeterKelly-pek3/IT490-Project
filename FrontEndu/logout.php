<?php

session_start();

// Destroy session
$_SESSION = array();

session_destroy();

// Redirect to loginRegister
header("Location: loginRegister.html");

exit();
?>

