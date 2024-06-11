<?php
@include 'config.php';

$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
$output = "";

$select_patient_Inco_Lab_data = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE (hospital_patient_no LIKE '%{$searchTerm}%' OR patient_name LIKE '%{$searchTerm}%'
 OR visit_id LIKE '%{$searchTerm}%' OR odp_idp_no LIKE '%{$searchTerm}%') AND status='tested' ORDER BY id ASC");
    
// $select_patient_Inco_Lab_data = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE status='tested' ORDER BY id ASC");

echo '
<div class="main-container-table">
              <div id="head-det">
             <div class="head-L11">
              <p><strong>Name</strong></p>
             </div>
             <div class="head-L22">
              <p><strong>HPT No</strong></p>
             </div>
             <div class="head-L33">
              <p><strong>Visit Id</strong></p>
             </div>
             <div class="head-L44">
              <p><strong>Return Time</strong></p>
             </div>
             <div class="head-L55">
              <p><strong>Sample No.</strong></p>
             </div>
              </div>
';
if (mysqli_num_rows($select_patient_Inco_Lab_data) > 0) { 

    while($row = mysqli_fetch_assoc($select_patient_Inco_Lab_data)){


        echo     '<div class="body-det" onclick="window.location.href=\'doctorpatient.php?HSPN='.$row["hospital_patient_no"].'&V_ID='.$row["visit_id"].'\'">
                <div class="bdy match-L11">
                  <p>'.$row["patient_name"].'</p>
                 </div>
                 <div class="bdy match-L22">
                  <p>'.$row["hospital_patient_no"].'</p>
                 </div>
                 <div class="bdy match-L33">
                  <p>'.$row["visit_id"].'</p>
                 </div>
                 <div class="bdy match-L44">
                  <p>'.$row["return_time"].' on '.$row["return_date"].'</p>
                 </div>
                 <div class="bdy match-L55">
                  <p>'.$row["sample_no"].'</p>
                 </div>
                 </div>';
            

               } }else{
                    echo '
                    <section id="no-det">
                    <h3>No Data Available...</h3>
                    </section>
                    ';
                    }
                    echo '</div>';

?>