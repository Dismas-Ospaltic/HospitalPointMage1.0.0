<?php
@include 'config.php';
 
if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

   $select_patient_data_card_btn = mysqli_query($conn, "SELECT hospital_patient_no,odp_idp_no FROM patient_details WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");

   if(mysqli_num_rows($select_patient_data_card_btn) > 0){ 
    $row = mysqli_fetch_assoc($select_patient_data_card_btn);
 

//     <button id="btn1" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/patientCard.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'\'); Addvisitvisible();"><i class="fa-solid fa-add"></i>Add Visit</button>
// <button id="btn2"><i class="fa-solid fa-user-doctor"></i>Send to Doctor</button>
// <button id="btn3"><i class="fa-solid fa-list-1-2"></i>Fix Appointment</button>
// <button id="btn4" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/patientCard.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'\'); changePatientDetailsupdatebtns(); displayUpdateCard();"><i class="fa-solid fa-edit"></i>Edit Patient Deteils</button> 

echo'
<button id="btn1" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'\'); OrderlLabWindow();"><i class="fa-solid fa-house-medical-circle-check"></i>Order Lab Test</button>
                        
<button id="btn3"  onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'\'); displayAppointmentCard(); "><i class="fa-solid fa-list-1-2"></i>Fix Appointment</button>
<button id="btn4"  onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&ODPIDP='.$row['odp_idp_no'].'\'); showDetWindoPatient(); displaypatientDetinField();"><i class="fa-solid fa-edit"></i>Edit Patient Deteils</button>
';
   }
   else{
   echo 'No Data!';
   }

}else{
    echo "not Set";
}
?> 