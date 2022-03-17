#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('DBFunctions.php');

echo "Retrieving API Data..\n";

getAPIConnection();

echo "Finished Retrieving API Data.\n";

?>

