<?php
@include 'config.php';

$text_mail = $_POST["text_mail"];
$text_answer = $_POST["text_answer"];

$san_text_mail = mysqli_real_escape_string($conn, $text_mail);
$san_text_answer = mysqli_real_escape_string($conn, $text_answer);

if(!empty($text_mail) && !empty($text_answer)){

    $check_ans = mysqli_query($conn, "SELECT email_address,security_quiz,quiz_ans FROM admin_data WHERE email_address='{$san_text_mail}' AND quiz_ans = '{$san_text_answer}'");
     if(mysqli_num_rows($check_ans)){
        $row = mysqli_fetch_assoc($check_ans);
        if(!empty($row["security_quiz"])){
            // echo $row["security_quiz"];
            echo "cor";
        }else{
        echo "no quiz";
        }
      
     }else{

        $check_ans = mysqli_query($conn, "SELECT email_address,security_quiz,quiz_ans FROM employee_data WHERE email_address='{$san_text_mail}' AND quiz_ans = '{$san_text_answer}'");
        if(mysqli_num_rows($check_ans)){
           $row = mysqli_fetch_assoc($check_ans);
           if(!empty($row["security_quiz"])){
               // echo $row["security_quiz"];
               echo "cor";
           }else{
           echo "no quiz";
           }
         
        }else{
       echo "incor";
        }

     }
}else{
    echo "empty field";
}






?>