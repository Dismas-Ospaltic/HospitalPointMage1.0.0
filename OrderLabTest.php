<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){

    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);
    
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

    ///select visit id

$VisitIDisset =false;

$select_visit_id = mysqli_query($conn, "SELECT visit_id FROM patient_sub_visit WHERE (hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND status='not_tend' LIMIT 1");
if(mysqli_num_rows($select_visit_id) > 0){
    $VisitIDisset =true;
    $row_inner = mysqli_fetch_assoc($select_visit_id);
    $visit_id = $row_inner["visit_id"];
}else{
    $VisitIDisset =false;   
}

//@end

    ///select patient details

    $PatientDet =false;

    $select_Det = mysqli_query($conn, "SELECT first_name,middle_name,last_name,hospital_patient_no,odp_idp_no FROM patient_details WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}' LIMIT 1");
    if(mysqli_num_rows($select_Det) > 0){
     
        $PatientDet  =true;
        $row_det = mysqli_fetch_assoc($select_Det);
       
        $patient_name = $row_det["first_name"]." ".$row_det["middle_name"]." ".$row_det["last_name"];
        $patient_hos_reg = $row_det["hospital_patient_no"];
        $patient_dept_no = $row_det["odp_idp_no"];

    }else{
        $PatientDet =false;  
    }
    
    //@end



 

$test_specification =$_POST["text_test_spec"];
$sample_to_collect =$_POST["text_sample"];
$other_spec =$_POST["other_spec"];


$san_test_specification = mysqli_real_escape_string($conn, $test_specification);
$san_sample_to_collect= mysqli_real_escape_string($conn, $sample_to_collect);
$san_other_spec = mysqli_real_escape_string($conn, $other_spec);


if(!empty($test_specification) && !empty($sample_to_collect)){
if($VisitIDisset){


    ///select if labExist

$LabExist =false;

$select_lab_exist_order = mysqli_query($conn, "SELECT visit_id FROM laboratory_test WHERE (hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND visit_id='{$visit_id}' AND status='not_tested' LIMIT 1");
if(mysqli_num_rows($select_lab_exist_order) > 0){
    $LabExist =true;
    // $row_inner = mysqli_fetch_assoc($select_visit_id);
    // $visit_id = $row_inner["visit_id"];
}else{
    $LabExist =false; 
}

//@end

if($PatientDet){

if(!$LabExist){
$Send_lab_test = mysqli_query($conn, "INSERT INTO laboratory_test(patient_name,hospital_patient_no,odp_idp_no,sample_list,test_specification,other_specification,visit_id,sent_by) 
VALUES('{$patient_name}','{$patient_hos_reg}','{$patient_dept_no}','{$sample_to_collect}','{$test_specification}','{$other_spec}','{$visit_id}','{$user}')");

if($Send_lab_test){
    echo "success";
}else{
    echo "failed";
}
}else{
    echo "test already added";
}

}else{
    echo "no det found";
}
}else{
    echo "no visit id";
}
}else{
    echo "empty";
}

}else{
    echo "not set";
}
?>