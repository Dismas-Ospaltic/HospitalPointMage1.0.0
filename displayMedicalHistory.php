<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

 $select_medical_hist = mysqli_query($conn, "SELECT p_med_hist FROM patient_details WHERE hospital_patient_no ='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");

if(mysqli_num_rows($select_medical_hist) > 0){
$row = mysqli_fetch_assoc($select_medical_hist);
echo '
<form action="#" method="post">
<p><strong>Note: use semi-colon (;) at end of each statement to separate lines *</strong></p>
<div class="input-wrapper">
<label>Medical History *</label>
<textarea  name="text_med_hist" placeholder="patient medical History. Allergies, Sex life etc...">'.$row["p_med_hist"].'</textarea>
</div>

<div class="btn-wrapper">
<button class="save-btn" onclick="EditMedicalHistory()"><i class="fa-solid fa-plus"></i>Save Changes</button>
</div>
</form>
';
}

}else{
    echo "not set";
}
?>