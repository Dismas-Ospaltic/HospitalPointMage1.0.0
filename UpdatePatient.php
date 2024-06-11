<?php
@include 'config.php';


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

// 

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


   //select existing patient
if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
$hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
$DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

$PatientExist = false;


$select_Patient = mysqli_query($conn, "SELECT odp_idp_no FROM patient_details WHERE odp_idp_no = '{$san_text_odp}'");
if (mysqli_num_rows($select_Patient) > 0) {  
    $row = mysqli_fetch_assoc($select_Patient);
    $odp_idp_no = $row["odp_idp_no"];
    if($odp_idp_no == $DP_NO){
        $PatientExist = false;
   }else{
        $PatientExist = true;
  }
  }else{
    $PatientExist = false;
  }


if(!empty($text_fname) && !empty($text_lname) && !empty($text_odp) && !empty($text_phone) && !empty($text_age) && !empty($text_gender)){
if(!$PatientExist){

    $Update_det = mysqli_query($conn, "UPDATE patient_details SET first_name='{$san_text_fname}',middle_name='{$san_text_mname}',
    last_name='{$san_text_lname}',age='{$san_text_age}',gender='{$san_text_gender}',odp_idp_no='{$san_text_odp}'
    ,nid='{$san_text_nid}',email='{$san_text_email}',phone='{$san_text_phone}',residence='{$san_text_residence}'
    ,insurance_comp='{$san_text_incomp}',insurance_no='{$san_text_inno}' WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");

if($Update_det){
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
}else{
    echo "not set";
}



?>
