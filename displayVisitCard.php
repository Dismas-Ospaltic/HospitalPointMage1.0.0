<?php
@include 'config.php';
$current_date = date("Y-m-d");

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

   $select_patient_Visit_card = mysqli_query($conn, "SELECT * FROM patient_sub_visit WHERE (hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND status='not_tend' ORDER BY id ASC");
      
   if(mysqli_num_rows($select_patient_Visit_card) > 0){
    while($row = mysqli_fetch_assoc($select_patient_Visit_card)){
   
    $visitDate = $row["visit_date"];
 echo ' <div class="visit-det-left">
   <label>';
   if($visitDate == $current_date){
   echo '<h4>Today\'s Visit</h4>';
    }
   echo '<span>'.$visitDate.'</span></label>
   <div class="visit-reason-cont">
     <p><strong>Visit Reason</strong></p>
     <p>'.$row["visit_reason"].'</p>
   </div>
  </div>


  <div class="visit-det-right">
   <ul>
     <li><div class="single-btn-like rec-vital"><i class="fa-solid fa-stethoscope"></i><p>Record Vitals</p></div></li>
     <li><div class="single-btn-like add-medical-note" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'\'); displaypatientMedicalNoteinField(); displayMedicalNoteWindow();"><i class="fa-solid fa-clipboard-check"></i><p>Add Medical Notes</p></div></li>
     <li><div class="single-btn-like lab-test" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); displaypatientVisitLabTestRes(); displayLabCard();"><i class="fa-solid fa-house-medical-circle-xmark"></i><p>View Laboratory Results</p></div></li>
     <li><div class="single-btn-like rec-bills" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'&V_ID='.$row['visit_id'].'\'); displayBillCard();"><i class="fa-solid fa-money-bill"></i><p>Record Medical Bills/ View invoice</p></div></li>
     <li><div class="single-btn-like view-dicharge" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'&V_ID='.$row['visit_id'].'\'); displaypatientVisitDischarge(); displayDischargeCard();"><i class="fa-solid fa-clipboard-question"></i><p>View Discharge Summary</p></div></li>
     <li><div class="single-btn-like print-discharge" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'&V_ID='.$row['visit_id'].'\'); displaypatientVisitDischarge(); printDischarge();"><i class="fa-solid fa-print"></i><p>Print Discharge Summary</p></div></li>
     <li><div class="single-btn-like send-pham"><i class="fa-solid fa-comments"></i><p>Send note to pharmacy</p></div></li>
     <li><div class="single-btn-like discharge-color" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'&V_ID='.$row['visit_id'].'\'); if (confirm(\'Are Sure You want to Discharge this Patient? make Sure every bill is recorded\')) { dischargePatientToday(); } "><i class="fa-solid fa-hospital-user"></i><p>discharge patient</p></div></li>
     <li><div class="single-btn-like discharge-color" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'&V_ID='.$row['visit_id'].'\'); if (confirm(\'Are Sure You want to mark this Patient as completed? this can be done when patient visit the hospital but leaves without seing a doctor\')) { dischargePatientInco(); } "><i class="fa-solid fa-hospital-user"></i><p>Mark As completed</p></div></li>
   </ul>
  </div>
   '; 
    }
   }else{
      echo '
      <section id="no-det">
      <h3>Once Visit added Will display here...</h3>
    </section>
      ';
   }

}else{
    echo "not Set";
}
?>