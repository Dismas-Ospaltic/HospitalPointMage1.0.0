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

$user_sent = $session_user;


if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
$hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
$DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);


$check_valid =false;
$select_patient_data = mysqli_query($conn, "SELECT hospital_patient_no,odp_idp_no,first_name,middle_name,last_name FROM patient_details WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");

if(mysqli_num_rows($select_patient_data) > 0){
$row = mysqli_fetch_assoc($select_patient_data);
$check_valid = true;
$patient_unique = $row["hospital_patient_no"];
$patient_pdno = $row["odp_idp_no"];
$patient_name = $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
}else{
$check_valid =false;
// echo 'not exist';
}




$text_reason= $_POST["text_reason"];
$text_dep= $_POST["text_dep"];
$text_vtype= $_POST["text_vtype"];
$text_vstatus= $_POST["text_vstatus"];

$san_text_reason=mysqli_real_escape_string($conn, $text_reason);
$san_text_dep=mysqli_real_escape_string($conn, $text_dep);
$san_text_vtype=mysqli_real_escape_string($conn, $text_vtype);
$san_text_vstatus=mysqli_real_escape_string($conn, $text_vstatus);

if(!empty($text_reason)){
if($check_valid){

$ExistVisit = false;
//select existing visit date
$select_patient_visit_day = mysqli_query($conn, "SELECT visit_date FROM patient_sub_visit WHERE hospital_patient_no='{$patient_unique}'");
if(mysqli_num_rows($select_patient_visit_day) > 0){
while($row = mysqli_fetch_assoc($select_patient_visit_day)){
 $visits = $row["visit_date"];
    if($visits == $current_date){
        $ExistVisit = true;
    }else{
        $ExistVisit = false; 
    }  
}
}else{
$ExistVisit = false;
}

///selcect counts

//code to assign number of visits
$select_count_patient_visit = mysqli_query($conn, "SELECT COUNT(*) FROM patient_sub_visit WHERE hospital_patient_no='{$patient_unique}'");
$number_visit_row = mysqli_fetch_array($select_count_patient_visit);
$total_visit= $number_visit_row[0] + 1;

//generate visit id

$patient_visit_ext = "VST";



$time = time();
$num_gen = rand(time(), 10000);

$visit_id = $num_gen.$patient_visit_ext.$total_visit;
 

if(!$ExistVisit){
$insert_visit = mysqli_query($conn, "INSERT INTO patient_sub_visit(visit,visit_reason,hospital_patient_no,odp_idp_no,department,urgency,visit_type,pateint_name,sent_by,visit_id)
 VALUES('{$total_visit}','{$san_text_reason}','{$patient_unique}','{$patient_pdno}','{$san_text_dep}','{$san_text_vstatus}','{$san_text_vtype}','{$patient_name}','{$user_sent}','{$visit_id}')");

if($insert_visit){
    echo "success";
}else{
    echo "failed";
}

}else{
    echo "visit exist";
}

}else{
echo "not valid";
}
}else{
    echo "empty";
}


}else{
    echo "not set";
}


?>