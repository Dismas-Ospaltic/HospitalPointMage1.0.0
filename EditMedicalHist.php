<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);
  $medical_hist = $_POST["text_med_hist"]; 
  $san_medical_hist = mysqli_real_escape_string($conn, $medical_hist);
   if(!empty($medical_hist)){
$select_medical_hist = mysqli_query($conn, "SELECT p_med_hist FROM patient_details WHERE hospital_patient_no ='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");



    $Add_medical_hist = mysqli_query($conn, "UPDATE patient_details SET p_med_hist ='{$san_medical_hist}' WHERE hospital_patient_no ='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");
if($Add_medical_hist){
    echo "success";
}else{
    echo "failed";
}

}else{
    echo "field empty";
}

}else{
    echo "not set";
}
?>