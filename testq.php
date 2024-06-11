<?php
session_start();
if(isset($_COOKIE['offline_back_triger'])){
$_SESSION['offline_back_triger']=$_COOKIE['offline_back_triger'];


setcookie('offline_back_triger', $_SESSION['offline_back_triger'], time() + 0, '/');
unset($_SESSION['offline_back_triger']);

session_destroy();
// header('Location: Login.php');
exit();
}

?>  