<?php

session_start();

//Check login and redirect
if (!$_SESSION["logged"])
{
    header("Location: /loginRegister.html");
}


include('webClient.php');
include('webFunctions.php');
//include('errors.php');


//Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/testserver/git/rabbitmqphp_example/FrontEnd/Logs/errLog.txt');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Esports Team Stats</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #588c7e;
            font-family: monospace;
            font-size: 25px;
            text-align: left;
        }
        th {
            background-color: #588c7e;
            color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>
</head>
<body>
<table>
    <tr>
        <th>Name</th>
        <th>Season</th>
        <th>Region</th>
        <th>Win Rate</th>
        <th>KD</th>
        <th>GPM</th>
        <th>GDM</th>
    </tr>
<?php
if ($_SESSION["logged"])
{
    
    $stats = getHistoricalStats();
    return $stats;
    echo var_dump($stats);
    
}
?>
