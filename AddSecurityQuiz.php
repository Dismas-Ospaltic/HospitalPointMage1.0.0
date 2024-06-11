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
 
$text_answer = $_POST["text_answer"];
$text_security = $_POST["text_security"];

$san_text_answer = mysqli_real_escape_string($conn, $text_answer);
$san_text_security = mysqli_real_escape_string($conn, $text_security);


if(!empty($text_answer) && !empty($text_security)){

    if($text_answer != "-Answered-" && $text_answer != "not Set..."){
$update_Det = mysqli_query($conn, "UPDATE admin_data SET security_quiz='{$san_text_security}', quiz_ans='{$san_text_answer}' WHERE email_address='{$session_user}'");

if($update_Det){
echo "added successfully";
}else{
    echo "failed";
} 
}else{
    echo "cannot";
}
}else{
echo "empty fields";
}

}else{
 
    $text_answer = $_POST["text_answer"];
    $text_security = $_POST["text_security"];
    
    $san_text_answer = mysqli_real_escape_string($conn, $text_answer);
    $san_text_security = mysqli_real_escape_string($conn, $text_security);
    
    
    if(!empty($text_answer) && !empty($text_security)){
        if($text_answer != "-Answered-" && $text_answer != "not Set..."){
    $update_Det = mysqli_query($conn, "UPDATE employee_data SET security_quiz='{$san_text_security}', quiz_ans='{$san_text_answer}' WHERE email_address='{$session_user}'");
    
    if($update_Det){
    echo "added successfully";
    }else{
        echo "failed";
    }
}else{
    echo "cannot";
}
    }else{
    echo "empty fields";
    }
}

}else{
    echo 'not set';
    }
    
    ?>