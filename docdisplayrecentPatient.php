<?php
@include 'config.php';

$select_recent_patient = mysqli_query($conn, "SELECT * FROM patient_sub_visit WHERE status='tend' ORDER BY id DESC LIMIT 10");


if(mysqli_num_rows($select_recent_patient) > 0){
    echo '<div class="main-container-table-recent">
    <div id="head-det">
   <div class="head-11">
    <p><strong>Name</strong></p>
   </div>';

//    <div class="head-22">
//     <p><strong>IDP /ODP No</strong></p>
//    </div>

  echo '<div class="head-33">
    <p><strong>HPT No</strong></p>
   </div>
</div>';
    while($row = mysqli_fetch_assoc($select_recent_patient)){
       echo '<div class="body-det">
        <div class="bdy match-11">
            <p>'.$row["pateint_name"].'</p>
           </div>';
        //    <div class="bdy match-22">
        //     <p>'.$row["odp_idp_no"].'</p>
        //    </div>
           echo '<div class="bdy match-33">
            <p>'.$row["hospital_patient_no"].'</p>
           </div>
       </div>';
    }

}else{
echo '
<section id="no-det">
<h3>No Data Available...</h3>
</section>';
           
}
echo '</div>';


?>