<?php
@include 'config.php';
$return_time = date('H:i:s', time());
$current_date = date("Y-m-d");


// select user
if(!isset($_COOKIE['text_role_hms']) && !isset($_COOKIE['text_mail_hms'])){
    header("Location:  Login.php");
    }
    
    $_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
    $_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];
    
    $session_user=$_SESSION['text_mail_hms'];
    $session_role=$_SESSION['text_role_hms'];
    
    if($session_role == "admin"){
    $select_admin_det = mysqli_query($conn, "SELECT * FROM admin_data WHERE email_address='{$session_user}'");
    if(mysqli_num_rows($select_admin_det) > 0){
      $row = mysqli_fetch_assoc($select_admin_det);
      $role = $row["role"];
      $adminName = $row["first_name"]." - ".$role;
     
    }else{
        $adminName = "no log";
    }
    }else{
      $select_other_det = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address='{$session_user}'");
    if(mysqli_num_rows($select_other_det) > 0){
      $row = mysqli_fetch_assoc($select_other_det);
      $role = $row["role"];
      $adminName = $row["first_name"]." - ".$role;
    }else{
        $adminName = "no log";
    }
    }

 
$user = $adminName;

if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
    $VISIT_ID  = mysqli_real_escape_string($conn, $_GET["V_ID"]);
    $HPT_NO = mysqli_real_escape_string($conn, $_GET["HSPN"]);

 $text_sampleno = $_POST["text_sampleno"];
 $samle_list = $_POST["samle_list"];
 $text_test = $_POST["text_test"];
 $test_result = $_POST["test_result"];
 $text_info = $_POST["text_info"];
  
 $san_text_sampleno=mysqli_real_escape_string($conn, $text_sampleno);
 $san_samle_list=mysqli_real_escape_string($conn,  $samle_list);
 $san_text_test=mysqli_real_escape_string($conn, $text_test);
 $san_test_result=mysqli_real_escape_string($conn, $test_result);
 $san_text_info=mysqli_real_escape_string($conn, $text_info);

if(!empty($text_sampleno) && !empty($samle_list) && !empty($text_test) && !empty($test_result)){

$add_lab_test = mysqli_query($conn, "UPDATE laboratory_test SET sample_no='{$san_text_sampleno}', sample_col='{$san_samle_list}'
,test_list='{$san_text_test}', test_result='{$san_test_result}', other_conclusion='{$san_text_info}', return_date='{$current_date}', return_time='{$return_time}',lab_tech='{$user}' WHERE hospital_patient_no='{$HPT_NO}' AND visit_id='{$VISIT_ID}' AND status='not_tested'");
if($add_lab_test){
echo "success";
}else{
    echo "failed";
}
}else{
    echo "empty";
}

}else{
    echo "not set";
}
?>