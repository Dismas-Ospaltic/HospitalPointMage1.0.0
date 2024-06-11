<?php
@include 'config.php';
$current_date = date("Y-m-d");

$select_Incoming = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE status='tested' AND request_date='{$current_date}' ORDER BY id DESC");
if(mysqli_num_rows($select_Incoming) > 0){

while($row = mysqli_fetch_assoc($select_Incoming)){
 echo '
<div class="single-cont">
<div class="left-sec">
<div class="avatar-name">
  <i class="fa-solid fa-hospital-user"></i>
  <div class="name-reason">
      <p><strong>'.$row["patient_name"].'</strong></p>
      <small>'.$row["sent_by"].'</small>
  </div>
</div>
<label>'.$row["request_date"].' at '.$row["request_time"].'</label>
</div>
<div class="right-sec">
 <label class="label-1" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/laboratory.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); displayLabDetCardForComlete(); displayLabDetCardForComp();"><i class="fa-solid fa-info-circle"></i>View Details</label>
 <label class="label-2" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/laboratory.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); displayAddLabResCard(); displayFieltoaddLabDet();"><i class="fa-solid fa-edit"></i>Edit</label>
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

?>