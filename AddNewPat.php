<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");

if(!isset($_COOKIE['text_role_hms']) && !isset($_COOKIE['text_mail_hms'])){

    $session_user="no log";
   $session_role="no log";
}

$_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
$_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];

$session_user=$_SESSION['text_mail_hms'];
$session_role=$_SESSION['text_role_hms'];



$user = $session_user;

$text_fname= $_POST["text_fname"];
$text_mname= $_POST["text_mname"];
$text_lname= $_POST["text_lname"];
$text_age= $_POST["text_age"];
$text_gender= $_POST["text_gender"];
$text_odp= $_POST["text_odp"];
$text_nid= $_POST["text_nid"];
$text_email= $_POST["text_email"];
$text_phone= $_POST["text_phone"];
$text_residence= $_POST["text_residence"];
$text_incomp= $_POST["text_incomp"];
$text_inno= $_POST["text_inno"];



$san_text_fname=mysqli_real_escape_string($conn, $text_fname);
$san_text_mname=mysqli_real_escape_string($conn, $text_mname);
$san_text_lname=mysqli_real_escape_string($conn, $text_lname);
$san_text_age=mysqli_real_escape_string($conn, $text_age);
$san_text_gender=mysqli_real_escape_string($conn, $text_gender);
$san_text_odp=mysqli_real_escape_string($conn, $text_odp);
$san_text_nid=mysqli_real_escape_string($conn, $text_nid);
$san_text_email=mysqli_real_escape_string($conn, $text_email);
$san_text_phone=mysqli_real_escape_string($conn, $text_phone);
$san_text_residence=mysqli_real_escape_string($conn, $text_residence);
$san_text_incomp=mysqli_real_escape_string($conn, $text_incomp);
$san_text_inno=mysqli_real_escape_string($conn, $text_inno);
// 
  //code to assign patient a unique Number
  $select_count_patients = mysqli_query($conn, "SELECT COUNT(*) FROM patient_details");
  $number_row = mysqli_fetch_array($select_count_patients);
  $total= $number_row[0] + 1;

  $patient_number_ext = "PN";
  $last_ext = "R";
 

  $time = time();
  $num_gen = rand(time(), 1000);

  $patient_hospital_No = $num_gen.$patient_number_ext.$total.$last_ext;
//    echo $patient_hospital_No;

   //select existing patient


$PatientExist = false;


$select_Patient = mysqli_query($conn, "SELECT odp_idp_no FROM patient_details WHERE odp_idp_no = '{$san_text_odp}'");
if (mysqli_num_rows($select_Patient) > 0) {  
    $PatientExist = true;
}else{
    $PatientExist = false;
}


if(!empty($text_fname) && !empty($text_lname) && !empty($text_odp) && !empty($text_phone) && !empty($text_age) && !empty($text_gender)){
if(!$PatientExist){

    $insert_det = mysqli_query($conn, "INSERT INTO patient_details(first_name,middle_name,last_name,age,gender,odp_idp_no,nid,email,phone,residence,insurance_comp,insurance_no,hospital_patient_no,user_add)
     VALUES('{$san_text_fname}','{$san_text_mname}','{$san_text_lname}','{$san_text_age}','{$san_text_gender}','{$san_text_odp}','{$san_text_nid}','{$san_text_email}','{$san_text_phone}','{$san_text_residence}','{$san_text_incomp}','{$san_text_inno}','{$patient_hospital_No}','{$user}')");

if($insert_det){
    echo "success";
}else{
    echo "failed";
}

}else{
    echo "Odp Exist";
}
}else{
    echo "empty";
}




?>
