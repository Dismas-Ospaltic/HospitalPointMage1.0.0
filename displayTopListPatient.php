<?php
@include 'config.php';
$current_date = date("Y-m-d");

$select_recent_patients = mysqli_query($conn, "SELECT pateint_name,hospital_patient_no FROM patient_sub_visit WHERE status='tend' LIMIT 10");
if(mysqli_num_rows($select_recent_patients) > 0){
 
    while($row = mysqli_fetch_assoc($select_recent_patients)){
        echo '
        <div class="rec-list-single">
        <label class="name-avatar"><i class="fa-solid fa-hospital-user"></i><span>'.$row["pateint_name"].'</span></label>
        <small>'.$row["hospital_patient_no"].'</small>
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

echo'
</div>';

?>