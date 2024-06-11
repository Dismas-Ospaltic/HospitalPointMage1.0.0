<?php
@include 'config.php';

$text_mail = $_POST["text_mail"];
$text_new1 = $_POST["text_new1"];
$text_new2 = $_POST["text_new2"];



$san_text_new1 = mysqli_real_escape_string($conn, $text_new1);
$san_text_new2 = mysqli_real_escape_string($conn, $text_new2);
$san_text_mail = mysqli_real_escape_string($conn, $text_mail);

if(!empty($text_mail) && !empty($san_text_new1) && !empty($san_text_new2)){

    $check_user = mysqli_query($conn, "SELECT email_address FROM admin_data WHERE email_address='{$san_text_mail}'");
     if(mysqli_num_rows($check_user)){
    $row = mysqli_fetch_assoc($check_user);
    $mail_user = $row["email_address"];

     
     if($san_text_new1 == $san_text_new2){
    
      $Update_passkey = mysqli_query($conn, "UPDATE admin_data SET pass_key='{$san_text_new2}' WHERE email_address='{$mail_user}'");
       if($Update_passkey){
       echo "success";
       }else{
         echo "failed";
       }
     }else{
        echo "not match";
     }
     }else{
     $check_user = mysqli_query($conn, "SELECT email_address FROM employee_data WHERE email_address='{$san_text_mail}'");
     if(mysqli_num_rows($check_user)){
      $row = mysqli_fetch_assoc($check_user);
      $mail_user = $row["email_address"];

   
         if($san_text_new1 == $san_text_new2){
          $Update_passkey = mysqli_query($conn, "UPDATE employee_data SET pass_key='{$san_text_new2}' WHERE email_address='{$mail_user}'");
           if($Update_passkey){
           echo "success";
           }else{
             echo "failed";
           }
           
         }else{
            echo "not match";
         }

        }else{
       echo "incor user";
        }

     }
}else{
    echo "empty fields";
}

?>