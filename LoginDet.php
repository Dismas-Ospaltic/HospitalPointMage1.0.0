<?php
@include 'config.php';

$text_role = $_POST["text_role"];
$text_mail = $_POST["text_mail"];
$text_passkey = $_POST["text_passkey"];

if(!empty($text_role) && !empty($text_mail) && !empty($text_passkey)){

    $san_text_role = mysqli_real_escape_string($conn, $text_role);
    $san_text_mail = mysqli_real_escape_string($conn, $text_mail);
    $san_text_passkey = mysqli_real_escape_string($conn, $text_passkey);

    if ($text_role == "admin"){
   $select_super_user = mysqli_query($conn, "SELECT * FROM admin_data WHERE email_address = '{$san_text_mail}' AND pass_key = '{$san_text_passkey}' LIMIT 1");
   if(mysqli_num_rows($select_super_user) > 0){
    $row = mysqli_fetch_assoc($select_super_user);

    setcookie('text_mail_hms' ,$row['email_address'],time()+60*60*8, '/');
    setcookie('text_role_hms' ,$row['role'],time()+60*60*8, '/');


    echo "login success";
    // header("Location:  index.php");
   }else{
    echo "incorect logins";
   }
    }
    else{
 // $select_user = mysqli_query($conn, "SELECT * FROM");
 $select_other_user = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address = '{$san_text_mail}' AND pass_key = '{$san_text_passkey}' LIMIT 1");
 if(mysqli_num_rows($select_other_user) > 0){
  $row = mysqli_fetch_assoc($select_other_user);

  setcookie('text_mail_hms' ,$row['email_address'],time()+60*60*8, '/');
  setcookie('text_role_hms' ,$row['role'],time()+60*60*8, '/');
 

  echo "login success";
  // header("Location:  index.php");
 }else{
  echo "incorect logins";
 }



    }

   



}else{
    echo "fill out all fields";
}





?>