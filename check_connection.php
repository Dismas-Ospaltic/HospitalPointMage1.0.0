<?php
function isInternetConnected()
{
    $connected = @fsockopen("ospalticsoftware.000webhostapp.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    }
    return false;
}

if (isInternetConnected()) {
    echo "online";
} else {
    echo "Check internet connection; you're currently offline";
}
?>
