<?php
session_start();
@include 'config.php';
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



$status ="tend";

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"]) && isset($_GET["V_ID"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);
   $VISIT_ID = mysqli_real_escape_string($conn, $_GET["V_ID"]);

$checkifInvoice = false;
$selecct_invoice = mysqli_query($conn, "SELECT * FROM invoice_list WHERE hospital_patient_no ='{$hospital_unique}' AND visit_id ='{$VISIT_ID}'");
if(mysqli_num_rows($selecct_invoice) > 0){
    $checkifInvoice = true;
}else{
    $checkifInvoice = false; 
}


$checkifdocNote = false;
$select_doc_note = mysqli_query($conn, "SELECT doctor_note FROM patient_sub_visit WHERE (hospital_patient_no ='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND visit_id ='{$VISIT_ID}'");
if(mysqli_num_rows($select_doc_note) > 0){
    $row_note = mysqli_fetch_assoc($select_doc_note);
    if($row_note["doctor_note"] != ""){
        $checkifdocNote = true;
    }else{
        $checkifdocNote = false; 
    }
}else{
    $checkifdocNote = false; 
}



if($checkifInvoice){
   if($checkifdocNote) {
$discharge = mysqli_query($conn, "UPDATE patient_sub_visit SET status='{$status}',discharge_date='{$current_date}',tend_by='{$user}' WHERE (hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND visit_id='{$VISIT_ID}'");
if($discharge){
   echo "success";
}else{
    echo "failed";
}

   }else{
    echo "doc notes lack";
   }
}else{
    echo "invoice lack";
}

}else{
    echo "not set";
}
?>