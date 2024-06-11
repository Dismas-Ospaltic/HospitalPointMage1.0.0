<?php
@include 'config.php';

$select_patient_Inco_data = mysqli_query($conn, "SELECT * FROM patient_sub_visit WHERE status='not_tend' ORDER BY id ASC");

echo '
<div class="main-container-table">
<div id="head-det">
<div class="head-1">
<p><strong>Name</strong></p>
</div>
<div class="head-2">
<p><strong>IDP /ODP No</strong></p>
</div>
<div class="head-3">
<p><strong>HPT No</strong></p>
</div>
<div class="head-4">
<p><strong>Visit Reason</strong></p>
</div>
<div class="head-5">
<p><strong>Urgency</strong></p>
</div>
<div class="head-6">
<p><strong>Visit Time</strong></p>
</div>
<div class="head-7">
<p><strong>Sent By</strong></p>
</div>
</div>   
';
if (mysqli_num_rows($select_patient_Inco_data) > 0) { 

while($row = mysqli_fetch_assoc($select_patient_Inco_data)){
echo '
 <div class="body-det" onclick="window.location.href=\'doctorpatient.php?HSPN='.$row["hospital_patient_no"].'&ODPIDP='.$row["odp_idp_no"].'\'">
 <div class="bdy match-1">
  <p>'.$row["pateint_name"].'</p>
 </div>
 <div class="bdy match-2">
  <p>'.$row["odp_idp_no"].'</p>
 </div>
 <div class="bdy match-3">
  <p>'.$row["hospital_patient_no"].'</p>
 </div>
 <div class="bdy match-4">
  <p>'.$row["visit_reason"].'</p>
 </div>
 <div class="bdy match-5">
  <p>'.$row["urgency"].'</p>
 </div>
 <div class="bdy match-6">
  <p>'.$row["visit_time"].' '.$row["visit_date"].'</p>
 </div>
 <div class="bdy match-7">
  <p>'.$row["sent_by"].'</p>
 </div>
  </div>
';
}

}else{
echo '
<section id="no-det">
<h3>No Data Available...</h3>
</section>
';
}
echo '
</div>
';

?>