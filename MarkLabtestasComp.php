<?php
@include 'config.php';
if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
    $VISIT_ID  = mysqli_real_escape_string($conn, $_GET["V_ID"]);
    $HPT_NO = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $select_Incoming = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE hospital_patient_no='{$HPT_NO}' AND visit_id='{$VISIT_ID}' AND status='not_tested'");
    if(mysqli_num_rows($select_Incoming) > 0){
    $row = mysqli_fetch_assoc($select_Incoming);
   if(!empty($row["sample_no"]) && !empty($row["sample_col"]) && !empty($row["test_list"]) && !empty($row["test_result"])){
    $update_status = mysqli_query($conn, "UPDATE laboratory_test SET status='tested' WHERE hospital_patient_no='{$HPT_NO}' AND visit_id='{$VISIT_ID}' AND status='not_tested'");
if($update_status){
echo "success";
}else{
echo "failed";
}
   }else{
    echo "empty data";
   }
    }else{

    }
}else{
    echo "not set";
}

?>