<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

$select_patient_data_card_btn = mysqli_query($conn, "SELECT * FROM patient_details WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");

if(mysqli_num_rows($select_patient_data_card_btn) > 0){
$row = mysqli_fetch_assoc($select_patient_data_card_btn);
echo '
<form action="#" method="post">
<div class="input-wrapper">
  <label>First name *</label>
  <input type="text" name="text_fname" placeholder="please enter first name..." value="'.$row["first_name"].'">
 </div>

 <div class="input-wrapper">
  <label>Middle name</label>
  <input type="text" name="text_mname" placeholder="please enter middle name..." value="'.$row["middle_name"].'">
 </div>


 <div class="input-wrapper">
  <label>last Name *</label>
  <input type="text" name="text_lname" placeholder="please enter last name..." value="'.$row["last_name"].'">
 </div>


 <div class="input-wrapper">
  <label>Age *</label>
  <input type="text" name="text_age" placeholder="please enter Age..." value="'.$row["age"].'">
 </div>

 <div class="input-wrapper">
  <label>Gender *</label>
  <select name="text_gender">
  <option value="'.$row["gender"].'">'.$row["gender"].'</option>
<option value="">--Select Gender--</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
  </select>
 </div> 


 <div class="input-wrapper">
  <label>ODP NO /IDP NO*</label>
  <input type="text" name="text_odp" placeholder="please enter ODP or IDP No..." value="'.$row["odp_idp_no"].'">
 </div>


 <div class="input-wrapper">
  <label>National Id/ Passport</label>
  <input type="text" name="text_nid" placeholder="please enter national Identity no..." value="'.$row["nid"].'">
 </div>

 <div class="input-wrapper">
  <label>email</label>
  <input type="text" name="text_email" placeholder="please enter email Address..." value="'.$row["email"].'">
 </div>

 <div class="input-wrapper">
  <label>Contact *</label>
  <input type="text" name="text_phone" placeholder="please enter phone No..." value="'.$row["phone"].'">
 </div>

 <div class="input-wrapper">
  <label>Residence</label>
  <input type="text" name="text_residence" placeholder="please enter patient residence..." value="'.$row["residence"].'">
 </div>

 <div class="input-wrapper">
  <label>Insurance Company</label>
  <input type="text" name="text_incomp" placeholder="please enter name of insurance company..." value="'.$row["insurance_comp"].'">
 </div>

 <div class="input-wrapper">
  <label>Insurance Member</label>
  <input type="text" name="text_inno" placeholder="please enter name of insurance No..." value="'.$row["insurance_no"].'">
 </div>

 <div class="btn-wrapper">
  <button class="save-btn" onclick="UpdatePatient();"><i class="fa-solid fa-plus"></i>Update Patient</button>
 </div>
</form>
';

}
else{
echo 'No Data!';
}

}else{
 echo "not Set";
}
?>