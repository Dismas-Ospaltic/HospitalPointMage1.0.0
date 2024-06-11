<?php
@include 'config.php';

$select_appointment = mysqli_query($conn, "SELECT * FROM app_upco_table WHERE status='not_tend' ORDER BY id ASC");

if(mysqli_num_rows($select_appointment) > 0){
    while($row = mysqli_fetch_assoc($select_appointment)){
 echo '
 <div class="single-cont">
 <div class="left-sec">
<div class="avatar-name">
   <i class="fa-solid fa-hospital-user"></i>
   <div class="name-reason">
       <p><strong>'.$row["patient_name"].'</strong></p>
       <small>'.$row["app_reason"].'</small>
   </div>
</div>
<label>'.$row["app_date"].' '.$row["app_start"].' - '.$row["app_end"].'</label>
 </div>
 <div class="right-sec">
  <label class="label-1" onclick="if (confirm(\'Are you Sure you Want Cancel this Appointment?\')) { window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctor.php?HSPN='.$row['hospital_patient_no'].'&APP_DATE='.$row["app_date"].'\'); cancelAppointment(); }"><i class="fa-solid fa-times-circle"></i>Cancel</label>
  <label class="label-2"><i class="fa-solid fa-clock"></i>Reschedule</label>
  <label class="label-3"  onclick="if (confirm(\'Are you Sure you Want Mark this As complete?\')) { window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctor.php?HSPN='.$row['hospital_patient_no'].'&APP_DATE='.$row["app_date"].'\'); markAppointment(); }"><i class="fa-solid fa-ticket"></i> Mark As complete</label>
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