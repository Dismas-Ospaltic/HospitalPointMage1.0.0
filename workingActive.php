<?php
$remoteScriptUrl = "http://ospalticsoftware.000webhostapp.com/Medvina/config.php";
$remoteContent = file_get_contents($remoteScriptUrl);
$response = json_decode($remoteContent, true);

if ($response['status'] === 'success') {
    $data = $response['data'];

    $text_token = $_POST["text_token"];


    // Replace 'desired_value' with the value you want to match
    $desiredValue = $text_token;


    if ($data['access_token'] === $desiredValue) {


        $time= $data['days'];
        setcookie('access' ,$row['access'],time()+60*60*24*$time, '/');
        echo "active";
     
        
    } else {
        echo "Value does not match.";
    }
} else {
    echo "Error: " . $response['message'];
}
?>