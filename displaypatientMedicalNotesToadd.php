<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);


   ///select visit id

$VisitIDisset =false;

$select_visit_id_det = mysqli_query($conn, "SELECT visit_id,cheif_complaint,doctor_note,diagnosis,medication,hospital_patient_no,odp_idp_no FROM patient_sub_visit WHERE (hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND status='not_tend' LIMIT 1");
if(mysqli_num_rows($select_visit_id_det) > 0){
    $VisitIDisset =true;
    $row_inner = mysqli_fetch_assoc($select_visit_id_det);
    $visit_id = $row_inner["visit_id"];
    $cheif_complaint = $row_inner["cheif_complaint"];
    $doctor_notes = $row_inner["doctor_note"];
    $diagnosis = $row_inner["diagnosis"];
    $medication = $row_inner["medication"];
    $hospital_reg =$row_inner["hospital_patient_no"];
    $patient_dept_no =$row_inner["odp_idp_no"];
}else{
    $VisitIDisset =false;   
}

//@end

if($VisitIDisset){

echo '
<form action="#" method="post">

<p><strong>Note: use semi-colon (;) at end of each statement to separate lines *</strong></p>
<div class="input-wrapper">
 <label>Cheif Complaints *</label>
 <textarea name="text_complaint" placeholder="Input patient\'s complaints e.g headache etc...">'.$cheif_complaint.'</textarea>
</div>   

<div class="input-wrapper">
 <label>Doctor\'s Notes *</label>
 <textarea name="text_docnotes" placeholder="Enter short notes...">'.$doctor_notes.'</textarea>
</div> 


<div class="input-wrapper">
    <label>Diagnosis *</label>
    <textarea name="text_diagnosis" placeholder="Enter the probable Diagnosis...">'.$diagnosis.'</textarea>
   </div> 


   <div class="input-wrapper">
    <label>Medication And Treatement *</label>
    <textarea name="text_medication" placeholder="Enter the medications and treatement notes...">'.$medication.'</textarea>
   </div> 



<div class="btn-wrapper">
<button class="save-btn" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$hospital_reg.'&ODPIDP='.$patient_dept_no.'&V_ID='.$visit_id.'\'); AddPatientMedicalNotesDoc();"><i class="fa-solid fa-clipboard-check"></i>Save Notes</button>
</div>
</form>
';


}else{
    echo "no visit id";
}


}else{
    echo "not set";
}
?>