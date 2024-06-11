<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");


if(isset($_COOKIE['text_role_hms']) && isset($_COOKIE['text_mail_hms'])){


$_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
$_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];

$session_user=$_SESSION['text_mail_hms'];
$session_role=$_SESSION['text_role_hms'];


$text_old = $_POST["text_old"];
$text_new1 = $_POST["text_new1"];
$text_new2 = $_POST["text_new2"];


$san_text_old = mysqli_real_escape_string($conn, $text_old);
$san_text_new1 = mysqli_real_escape_string($conn, $text_new1);
$san_text_new2 = mysqli_real_escape_string($conn, $text_new2);


if(!empty($text_old) && !empty($text_new1) && !empty($text_new2)){

    if($session_role == "admin"){
        $select_admin_det = mysqli_query($conn, "SELECT pass_key FROM admin_data WHERE email_address='{$session_user}' AND pass_key='{$san_text_old}'");
        if(mysqli_num_rows($select_admin_det) > 0){
          $row = mysqli_fetch_assoc($select_admin_det);

           $oldpass_key= $row["pass_key"];
         
         if($san_text_new1 == $san_text_new2){
           if($san_text_new1 == $san_text_old){
            echo "old is equal new";
           }else{
          $Update_passkey = mysqli_query($conn, "UPDATE admin_data SET pass_key='{$san_text_new2}' WHERE email_address='{$session_user}'");
           if($Update_passkey){
           echo "success";
           }else{
             echo "failed";
           }
            }
         }else{
            echo "not match";
         }
        }else{
        echo "incorrect old";
        }
        }else{
          $select_other_det = mysqli_query($conn, "SELECT pass_key FROM employee_data WHERE email_address='{$session_user}' AND pass_key='{$san_text_old}'");
        if(mysqli_num_rows($select_other_det) > 0){
          $row = mysqli_fetch_assoc($select_other_det);
          $oldpass_key= $row["pass_key"];
         
          if($san_text_new1 == $san_text_new2){
            if($san_text_new1 == $san_text_old){
             echo "old is equal new";
            }else{
           $Update_passkey = mysqli_query($conn, "UPDATE employee_data SET pass_key='{$san_text_new2}' WHERE email_address='{$session_user}'");
            if($Update_passkey){
            echo "success";
            }else{
              echo "failed";
            }
             }
          }else{
             echo "not match";
          }
        
        }else{
        echo "incorrect old";
        }
        }

}else{
    echo "empty fields";
}

}else{

}



?>