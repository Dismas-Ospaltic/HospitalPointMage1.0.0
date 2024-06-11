<?php
@include 'config.php';
 
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
$output = "";

$select_patient_data = mysqli_query($conn, "SELECT * FROM patient_details  WHERE hospital_patient_no LIKE '%{$searchTerm}%' OR nid LIKE '%{$searchTerm}%' OR first_name LIKE '%{$searchTerm}%'
 OR middle_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%' OR odp_idp_no LIKE '%{$searchTerm}%' OR phone LIKE '%{$searchTerm}%' OR residence LIKE '%{$searchTerm}%'");
    
echo '
<div class="main-container-table">
<div id="head-det">
<div class="head-1ap">
<p><strong>Name</strong></p>
</div>
<div class="head-3ap">
<p><strong>HPT No</strong></p>
</div>
<div class="head-2ap">
<p><strong>IDP /ODP No</strong></p>
</div>
<div class="head-4ap">
<p><strong>National Id</strong></p>
</div>
<div class="head-5ap">
<p><strong>Contact</strong></p>
</div>
<div class="head-6ap">
<p><strong>Residence</strong></p>
</div>
<div class="head-7ap">
<p><strong>Added On</strong></p>
</div>
<div class="head-8ap">
<p><strong>Added By</strong></p>
</div>
</div>
';
if(mysqli_num_rows($select_patient_data) > 0){


    while($row = mysqli_fetch_assoc($select_patient_data)){
        echo '
        <div class="body-det" onclick="window.location.href=\'patientCard.php?HSPN='.$row["hospital_patient_no"].'&ODPIDP='.$row["odp_idp_no"].'\'">
        <div class="bdy match-1ap">
         <p>'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</p>
        </div>
        <div class="bdy match-3ap">
         <p>'.$row["hospital_patient_no"].'</p>
        </div>
        <div class="bdy match-2ap">
         <p>'.$row["odp_idp_no"].'</p>
        </div>
        <div class="bdy match-4ap">
         <p>'.$row["nid"].'</p>
        </div>
        <div class="bdy match-5ap">
         <p>'.$row["phone"].'</p>
        </div>
        <div class="bdy match-6ap">
         <p>'.$row["residence"].'</p>
        </div>
        <div class="bdy match-7ap">
         <p>'.$row["add_date"].'</p>
        </div>
        <div class="bdy match-8ap">
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