<?php
if (!isset($_COOKIE['offline_back_triger'])) {
    // Cookies do not exist, consider them expired
    echo "expired";
}else{
    echo "set";
}

?>