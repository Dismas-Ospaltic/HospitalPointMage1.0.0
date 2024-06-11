<?php
@include 'config.php';

$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
$output = "";

$select_patient_Invoice_data = mysqli_query($conn, "SELECT * FROM patient_details  WHERE hospital_patient_no LIKE '%{$searchTerm}%' OR nid LIKE '%{$searchTerm}%' OR first_name LIKE '%{$searchTerm}%'
 OR middle_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%' OR odp_idp_no LIKE '%{$searchTerm}%' OR phone LIKE '%{$searchTerm}%' OR residence LIKE '%{$searchTerm}%'");

if(mysqli_num_rows($select_patient_Invoice_data) > 0){


while($row = mysqli_fetch_assoc($select_patient_Invoice_data)){
// $select_visit_id = mysqli_query($conn, "SELECT visit_id FROM patient_sub_visit WHERE hospital_patient_no LIKE '%{$searchTerm}%' AND status='not_tend' LIMIT 1");
// $row_inner = mysqli_fetch_assoc($select_visit_id);'&V_ID='.$row_inner['visit_id'].


echo '<div class="single-result"  onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/billing.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'\'); removeAutoList(); ChangeInvoice();">'.$row["first_name"].' '.$row["last_name"].' Reg No.: '.$row["hospital_patient_no"].' ODP /IDP No.: '.$row["odp_idp_no"].'</div>';
}
}else{
echo '
<section id="no-det">
<h3>No Data Available...</h3>
</section>
';
}

?> 