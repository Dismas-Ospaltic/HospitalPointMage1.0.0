<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");

if(isset($_COOKIE['text_role_hms']) && isset($_COOKIE['text_mail_hms'])){


$_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
$_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];

$session_user=$_SESSION['text_mail_hms'];
$session_role=$_SESSION['text_role_hms'];

if($session_role == "admin"){

$text_fname = $_POST["text_fname"];
$text_mname = $_POST["text_mname"];
$text_lname = $_POST["text_lname"];
$text_mail = $_POST["text_mail"];
$text_phone = $_POST["text_phone"];

$san_text_fname = mysqli_real_escape_string($conn, $text_fname);
$san_text_mname = mysqli_real_escape_string($conn, $text_mname);
$san_text_lname = mysqli_real_escape_string($conn, $text_lname);
$san_text_mail = mysqli_real_escape_string($conn, $text_mail);
$san_text_phone = mysqli_real_escape_string($conn, $text_phone);


if(!empty($text_fname) && !empty($text_lname) && !empty($text_mail) && !empty($text_phone)){

$update_Det = mysqli_query($conn, "UPDATE admin_data SET first_name='{$san_text_fname}', middle_name='{$san_text_mname}', last_name='{$san_text_lname}', email_address='{$san_text_mail}',contact='{$san_text_phone}' WHERE email_address='{$session_user}'");

if($update_Det){
echo "added successfully";
}else{
    echo "failed";
}

}else{
echo "empty fields";
}

}

}else{
    echo 'not set';

    }
    
    ?>