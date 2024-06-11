<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["APP_DATE"])){

$hospital_no = mysqli_real_escape_string($conn, $_GET["HSPN"]);
$date = mysqli_real_escape_string($conn, $_GET["APP_DATE"]);
$update_status = mysqli_query($conn, "UPDATE app_upco_table SET status='tend',action='complete' WHERE app_date='{$date}' AND hospital_patient_no='{$hospital_no}'");


if($update_status){
echo "success";
}else{
    echo "failed";
}
}else{
    echo "not set";
}
?>