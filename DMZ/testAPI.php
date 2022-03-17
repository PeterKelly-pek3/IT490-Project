#!/usr/bin/php
<?php


$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.b365api.com/v3/events/upcoming?sport_id=151&token=115215-MDpRLi6nUUlglr",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",

]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    foreach($data['results'] as &$value) {
        $LOL = $value['league']['name'];
        $word = "LOL";
        if(strpos($LOL, $word) !== false){
            echo "<br>";
            echo "League Name: ".$LOL;
            echo "<br>";
            echo "Home Team: ".$value['home']['name'];
            echo "<br>";
            echo "Away Team: ".$value['away']['name'];
            echo "<br>";
            $epoch = $value['time'];
            $dt = new DateTime("@$epoch");
            echo $dt->format('Y-m-d H:i:s');
            echo "<br>";
            echo "Event ID: ".$value['id'];
            echo "<br>";
        }

    }



}
