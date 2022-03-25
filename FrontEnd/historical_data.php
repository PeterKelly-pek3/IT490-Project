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

console.log("hello world");
if (isset($_POST['Get_Stats']))
{
    $response = getHistoricalStats();

}
$array = json_decode($response,true);
console.log($array);
foreach($array as $value) {
    foreach($value as $data) {
        echo "<br>";
        $Name = $data['Name'];
        echo "Name: ".$Name;
        echo "<br>";
        $Season = $data['Season'];
        echo "Season: ".$Season;
        echo "<br>";
        $Region = $data['Region'];
        echo "Region: ".$Region;
        echo "<br>";
        $Games = $data['Games'];
        echo "Name: ".$Games;
        echo "<br>";
        $Win_rate = $data['trimWin_rate'];
        echo "Win Rate: ".$Win_rate;
        echo "<br>";
        $KD = $data['KD'];
        echo "KD: ".$KD;
        echo "<br>";
        $GPM = $data['GPM'];
        echo "GPM: ".$GPM;
        echo "<br>";
        $GDM = $data['GDM'];
        echo "GDM: ".$GDM;
        echo "<br>";
    }

}

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
</table>
</body>
</html>

