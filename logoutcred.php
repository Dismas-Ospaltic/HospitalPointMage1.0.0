<?php
session_start();
if(isset($_COOKIE['text_role_hms']) && isset($_COOKIE['text_mail_hms'])){
$_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
$_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];

setcookie('text_mail_hms', $_SESSION['text_mail_hms'], time() + 0, '/');
setcookie('text_role_hms', $_SESSION['text_role_hms'], time() + 0, '/');
unset($_SESSION['text_mail_hms']);
unset($_SESSION['text_role_hms']);
session_destroy();
// header('Location: Login.php');
exit();
}
?>