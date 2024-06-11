<?php
@include 'config.php';
$current_date = date("Y-m-d");
$user ="joe";

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"]) && isset($_GET["V_ID"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);
   $VISIT_ID = mysqli_real_escape_string($conn, $_GET["V_ID"]);


   $text_complaint = $_POST["text_complaint"];
   $text_docnotes = $_POST["text_docnotes"];
   $text_diagnosis = $_POST["text_diagnosis"];
   $text_medication = $_POST["text_medication"];

   $san_text_complaint = mysqli_real_escape_string($conn, $text_complaint);
   $san_text_docnotes = mysqli_real_escape_string($conn, $text_docnotes);
   $san_text_diagnosis = mysqli_real_escape_string($conn, $text_diagnosis);
   $san_text_medication = mysqli_real_escape_string($conn, $text_medication);


if(!empty($text_complaint) && !empty($san_text_docnotes) && !empty($san_text_diagnosis) && !empty($san_text_medication)){

$Add_medical_notes =mysqli_query($conn, "UPDATE patient_sub_visit SET cheif_complaint='{$san_text_complaint}',doctor_note='{$san_text_docnotes}',diagnosis='{$san_text_diagnosis}',medication='{$san_text_medication}',tend_by='{$user}' WHERE (hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND visit_id='{$VISIT_ID}' AND status='not_tend'");
if($Add_medical_notes){
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
