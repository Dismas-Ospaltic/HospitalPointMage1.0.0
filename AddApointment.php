<?php
@include 'config.php';

if(isset($_GET["HSPN"])){
$hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
 $text_AppDate= $_POST["text_AppDate"];
 $text_Stime= $_POST["text_Stime"];
 $text_Ftime= $_POST["text_Ftime"];
 $text_appReason= $_POST["text_appReason"];


 $san_text_AppDate = mysqli_real_escape_string($conn, $text_AppDate);
 $san_text_Stime = mysqli_real_escape_string($conn, $text_Stime);
 $san_text_Ftime = mysqli_real_escape_string($conn, $text_Ftime);
 $san_text_appReason = mysqli_real_escape_string($conn, $text_appReason);


 $select_det = mysqli_query($conn, "SELECT first_name,middle_name,last_name,hospital_patient_no FROM patient_details WHERE hospital_patient_no='{$hospital_unique}'");
 if(mysqli_num_rows($select_det) > 0){

    $row =mysqli_fetch_assoc($select_det);

    $patient_name = $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
    $reg_no = $row["hospital_patient_no"];

    if(!empty($text_AppDate) && !empty($text_Stime) && !empty($text_Ftime) && !empty($text_appReason)){

        $select_appointment_date = mysqli_query($conn, "SELECT app_date FROM app_upco_table WHERE app_date='{$san_text_AppDate}' AND hospital_patient_no='{$reg_no}'");
        if(mysqli_num_rows($select_appointment_date) > 0){
            echo "exist";
        }else{
            $add_appointment = mysqli_query($conn, "INSERT INTO app_upco_table (app_date,app_start,app_end,app_reason,hospital_patient_no,patient_name) VALUES('{$san_text_AppDate}','{$san_text_Stime}','{$san_text_Ftime}','{$san_text_appReason}','{$reg_no}','{$patient_name}')");
            if($add_appointment){
               echo "success";
            }else{
               echo "failed";
            }
            
        }
 }else{
    echo "empty";
 }
}else{
    echo "no data";
 }

}else{
    echo "not set";
}
?>