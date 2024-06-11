<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

   $text_fname =$_POST["text_fname"];
   $text_mname =$_POST["text_mname"];
   $text_lname =$_POST["text_lname"];
   $text_age =$_POST["text_age"];
   $text_gender =$_POST["text_gender"];
   $text_blood =$_POST["text_blood"];
   $text_height =$_POST["text_height"];
   $text_weight =$_POST["text_weight"];
  
   $san_text_fname = mysqli_real_escape_string($conn, $text_fname);
   $san_text_mname = mysqli_real_escape_string($conn, $text_mname);
   $san_text_lname = mysqli_real_escape_string($conn, $text_lname);
   $san_text_age = mysqli_real_escape_string($conn, $text_age);
   $san_text_gender = mysqli_real_escape_string($conn, $text_gender);
   $san_text_blood = mysqli_real_escape_string($conn, $text_blood);
   $san_text_height = mysqli_real_escape_string($conn, $text_height);
   $san_text_weight = mysqli_real_escape_string($conn, $text_weight);
  
if(!empty($text_fname) && !empty($text_lname) && !empty($text_age) && !empty($text_gender)){

$Update_details =mysqli_query($conn, "UPDATE patient_details SET first_name='{$san_text_fname}', middle_name='{$san_text_mname}', last_name='{$text_lname}',
age='{$san_text_age}', gender='{$san_text_gender}', p_blood_type='{$san_text_blood}',p_weight='{$san_text_weight}',height='{$san_text_height}' WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");

if($Update_details){
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