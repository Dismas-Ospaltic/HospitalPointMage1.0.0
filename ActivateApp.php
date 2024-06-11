<?php
  $text_token = $_POST["text_token"];
  if(!empty($text_token)){
    $remoteScriptUrl = "http://ospalticsoftware.000webhostapp.com/Medvina/config.php";
    $remoteContent = file_get_contents($remoteScriptUrl);
    $response = json_decode($remoteContent, true);
    
    if ($response['status'] === 'success') {
        $data = $response['data'];
        // Replace 'desired_value' with the value you want to match
        $desiredValue = $text_token;
        if ($data['access_token'] === $desiredValue) {
            $time = $data['days'];
            // Set the cookie
            setcookie('access', $data['access_token'], time() + 60 * 60 * 24 * $time, '/');
           
            echo "activated... - click Go to app";
        } else {
            echo "Value does not match";
        }
    } else {
        echo "Error: " . $response['message'];
    }
  }else{
    echo "Please enter the Activate token";
  }
     
?>   
