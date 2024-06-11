<?php
@include 'config.php';

$select_Incoming = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE status='not_tested' ORDER BY id DESC");
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
  <label class="label-1" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/laboratory.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); displayLabDetCard(); displayDetailsInco();"><i class="fa-solid fa-info-circle"></i>View Details</label>
  <label class="label-4" onclick="if (confirm(\'Are you Sure Mark this As complete?\')) { window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/laboratory.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); CancelOrderLab(); }"><i class="fa-solid fa-times-circle"></i>Cancel</label>
  <label class="label-2" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/laboratory.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); displayAddLabResCard(); displayFieltoaddLabDet();"><i class="fa-solid fa-plus-circle"></i>Add Test & Results</label>
  <label class="label-3" onclick="if (confirm(\'Are you Sure Mark this As complete?\')) { window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/laboratory.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); MarkTestAsComplete(); }"><i class="fa-solid fa-ticket"></i> Mark As complete</label>
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