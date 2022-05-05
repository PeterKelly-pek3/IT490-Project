#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('DBFunctions.php');

echo "Retrieving Odds API Data..\n";

getOdds();

echo "Finished Retrieving Odds API Data.\n";

?>
