<?php


if (!isset($_COOKIE['text_mail_hms']) && !isset($_COOKIE['text_role_hms'])) {
    // Cookies do not exist, consider them expired
    echo "expired";
    exit();
}

$textMailExpiration = time() + 60; // Set the expiration time for 'text_mail' cookie (in seconds)
$textRoleExpiration = time() + 60; // Set the expiration time for 'text_role' cookie (in seconds)

if ($_COOKIE['text_mail'] === "" || $_COOKIE['text_role'] === "" ||
    time() > $textMailExpiration || time() > $textRoleExpiration) {
    // Either of the cookies is empty or expired
    echo "expired";
    exit();
}

// Cookies are still valid
echo "valid";


?>
