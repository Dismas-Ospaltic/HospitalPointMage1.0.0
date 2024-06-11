<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $VISIT_ID = mysqli_real_escape_string($conn, $_GET["V_ID"]);

    $select_patient_det = mysqli_query($conn, "SELECT first_name,last_name,middle_name,p_med_hist,age,gender,hospital_patient_no FROM patient_details WHERE hospital_patient_no='{$hospital_unique}'");
    if(mysqli_num_rows($select_patient_det) > 0){
       $row_det =mysqli_fetch_assoc($select_patient_det);

      $patient_name = $row_det["first_name"]." ".$row_det["middle_name"]." ".$row_det["last_name"];
     $hspt_reg =$row_det["hospital_patient_no"];
     $gender = $row_det["gender"];
     $age = $row_det["age"];
    }else{
        $patient_name = "";
        $hspt_reg ="";
        $gender = "";
        $age = "";
    }

   $select_visits_det =mysqli_query($conn, "SELECT * FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND visit_id='{$VISIT_ID}'");

   if(mysqli_num_rows($select_visits_det) > 0){
  $row = mysqli_fetch_assoc($select_visits_det); 
  
echo '
<div id="discharge">
<div class="main-head">
  <h1>Patient visit over view Notes</h1>
</div>
<div class="patient-overview">
 <label><h3>patient: '.$patient_name.'</h3><span>'.$age.' year old '.$gender.'</span></label>
 <label><strong>Hospital Reg No.:</strong><span>'.$hspt_reg.'</span></label>
</div>
<div class="det-discharge">
 <label><strong>Medical History</strong></label>';

   
echo '</div>

<div class="det-discharge">
<label><strong>Cheif Complaint</strong></label>';

if(!empty($row["cheif_complaint"])){

    $select_cheif_complaint = mysqli_query($conn, "SELECT cheif_complaint FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND visit_id='{$VISIT_ID}'");
    $data1=mysqli_fetch_array($select_cheif_complaint);
    $res1=$data1['cheif_complaint'];

    $res1=explode(";",$res1);

    $count1=count($res1)-1;

    for($i=0; $i<=$count1;$i++){
     $split_cheif_complait=$res1[$i];

     echo '<p>'.$split_cheif_complait.'</p>';
   }
}

echo '</div>

<div class="det-discharge">
<label><strong>Doctor\'s Notes</strong></label>';

 if(!empty($row["doctor_note"])){

    $select_doctor_note = mysqli_query($conn, "SELECT doctor_note FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND visit_id='{$VISIT_ID}'");
    $data2=mysqli_fetch_array($select_doctor_note);
    $res2=$data2['doctor_note'];

    $res2=explode(";",$res2);

    $count2=count($res2)-1;

    for($i=0; $i<=$count2;$i++){
     $split_doc_note=$res2[$i];

     echo '<p>'.$split_doc_note.'</p>';
   }
}
echo '</div>

<div class="det-discharge">
<label><strong>Diagnosis</strong></label>';

if(!empty($row["diagnosis"])){

    $select_diadnosis = mysqli_query($conn, "SELECT diagnosis FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND visit_id='{$VISIT_ID}'");
    $data3=mysqli_fetch_array($select_diadnosis);
    $res3=$data3['diagnosis'];

    $res3=explode(";",$res3);

    $count3=count($res3)-1;

    for($i=0; $i<=$count3;$i++){
     $split_diagnosis=$res3[$i];

     echo '<p>'.$split_diagnosis.'</p>';
   }
}

echo '</div> 

<div class="det-discharge">
<label><strong>Treatement And Medication</strong></label>';
if(!empty($row["medication"])){

    $select_medication = mysqli_query($conn, "SELECT medication FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND visit_id='{$VISIT_ID}'");
    $data4=mysqli_fetch_array($select_medication);
    $res4=$data4['medication'];

    $res4=explode(";",$res4);

    $count4=count($res4)-1;

    for($i=0; $i<=$count4;$i++){
     $split_medication=$res4[$i];

     echo '<p>'.$split_medication.'</p>';
   }
}


echo '</div>
<div id="man-water-mark">
<label><small>This system was designed by </small><span>Ospaltic Software Solutions</span></label>
<label><small><i class="fa-solid fa-phone"></i>Contact: </small><span>+254742354784, +254736218327</span></label>
<label><small><i class="fa-solid fa-envelope"></i>Email: </small><span>ospaltic@gmail.com</span></label>
<label><small><i class="fa-solid fa-f"></i>facebook: </small><span>Ospaltic</span></label>
</div>
</div>
';
   }else{

   }

}else{
    echo "not set";
}



?>