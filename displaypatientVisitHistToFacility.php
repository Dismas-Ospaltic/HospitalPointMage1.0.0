<?php
@include 'config.php';
$tend ="tend";
if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);
    
   $select_visits =mysqli_query($conn, "SELECT visit_date,visit_time,discharge_date,visit_id,visit_reason,tend_by,hospital_patient_no,odp_idp_no FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND status='{$tend}' ORDER BY id DESC");
    echo '<div class="main-container-table">
    <div id="head-det">
    <div class="head-1">
     <p><strong>Visit Date</strong></p>
    </div>
    <div class="head-2">
     <p><strong>Discharge Date</strong></p>
    </div>
    <div class="head-3">
     <p><strong>Visit Id</strong></p>
    </div>
    <div class="head-4">
     <p><strong>Visit Reason</strong></p>
    </div>
    <div class="head-5">
     <p><strong>Tend By</strong></p>
    </div>
     </div>
    ';
   if(mysqli_num_rows($select_visits) > 0){

 
   while($row = mysqli_fetch_assoc($select_visits)){
 echo '
 <div class="body-det" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); displaypatientVisitHistorytoFacilityMoreDet(); displayVistDataHist();">
 <div class="bdy match-1">
  <p>'.$row["visit_date"].' at '.$row["visit_time"].'</p>
 </div>
 <div class="bdy match-2">
  <p>'.$row["discharge_date"].'</p>
 </div>
 <div class="bdy match-3">
  <p>'.$row["visit_id"].'</p>
 </div>
 <div class="bdy match-4">
  <p>'.$row["visit_reason"].'</p>
 </div>
 <div class="bdy match-5">
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