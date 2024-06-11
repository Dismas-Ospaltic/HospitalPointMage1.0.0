<?php
@include 'config.php';

$select_patient_data = mysqli_query($conn, "SELECT * FROM patient_details");

echo '
<div class="main-container-table">
<div id="head-det">
<div class="head-1">
<p><strong>Name</strong></p>
</div>
<div class="head-3">
<p><strong>HPT No</strong></p>
</div>
<div class="head-2">
<p><strong>IDP /ODP No</strong></p>
</div>
<div class="head-4">
<p><strong>National Id</strong></p>
</div>
<div class="head-5">
<p><strong>Contact</strong></p>
</div>
<div class="head-6">
<p><strong>Residence</strong></p>
</div>
<div class="head-7">
<p><strong>Added On</strong></p>
</div>
<div class="head-8">
<p><strong>Added By</strong></p>
</div>
</div>
';
if (mysqli_num_rows($select_patient_data) > 0) { 

while($row = mysqli_fetch_assoc($select_patient_data)){
echo '
<div class="body-det" onclick="window.location.href=\'patientCard.php?HSPN='.$row["hospital_patient_no"].'&ODPIDP='.$row["odp_idp_no"].'\'">
<div class="bdy match-1">
 <p>'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</p>
</div>
<div class="bdy match-3">
 <p>'.$row["hospital_patient_no"].'</p>
</div>
<div class="bdy match-2">
 <p>'.$row["odp_idp_no"].'</p>
</div>
<div class="bdy match-4">
 <p>'.$row["nid"].'</p>
</div>
<div class="bdy match-5">
 <p>'.$row["phone"].'</p>
</div>
<div class="bdy match-6">
 <p>'.$row["residence"].'</p>
</div>
<div class="bdy match-7">
 <p>'.$row["add_date"].'</p>
</div>
<div class="bdy match-8">
 <p>'.$row["user_add"].'</p>
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