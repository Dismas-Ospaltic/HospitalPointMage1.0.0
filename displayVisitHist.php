<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

$select_patient_data_visits = mysqli_query($conn, "SELECT * FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}' ORDER BY id DESC");
echo'
<div class="main-container-table">
<div id="head-det">
<div class="head-1">
<p><strong>Visit</strong></p>
</div>
<div class="head-2">
<p><strong>Reason</strong></p>
</div>
<div class="head-3">
<p><strong>Department</strong></p>
</div>
<div class="head-4">
<p><strong>Visit Date</strong></p>
</div>
<div class="head-5">
<p><strong>Discharge Date</strong></p>
</div>
<div class="head-6">
<p><strong>Doctor</strong></p>
</div>

</div>
';
if(mysqli_num_rows($select_patient_data_visits) > 0){

while($row = mysqli_fetch_assoc($select_patient_data_visits)){
echo '
<div class="body-det">
<div class="bdy match-1">
    <p>'.$row["visit"].'</p>
   </div>
   <div class="bdy match-2">
    <p>'.$row["visit_reason"].'</p>
   </div>
   <div class="bdy match-3">
    <p>'.$row["department"].'</p>
   </div>
   <div class="bdy match-4">
    <p>'.$row["visit_date"].'</p>
   </div>
   <div class="bdy match-5">
    <p>'.$row["discharge_date"].'</p>
   </div>
   <div class="bdy match-6">
    <p>'.$row["tend_by"].'</p>
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

echo '</div>';

}else{
    echo "not set";
}
?>