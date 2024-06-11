<?php
function isInternetConnected()
{
    $connected = @fsockopen("www.ospaltic1.000webhostapp.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    }
    return false;
}

if (isInternetConnected()) {
    echo "online";
} else {
    echo "offline";
}
?>
