<?php
@include 'config.php';
$current_date = date("Y-m-d");


$select_count= mysqli_query($conn, "SELECT COUNT(*) FROM app_upco_table WHERE status='not_tend' AND app_date='{$current_date}'");
$number_row = mysqli_fetch_array($select_count);
$total_count= $number_row[0];

echo '<div class="header-sec-app">
<h3>Today\'s Appointments</h3>
<label class="app-num">'.$total_count.'</label>
</div>
<div class="app-list">';
$select_appointment = mysqli_query($conn, "SELECT patient_name,app_start,app_end FROM app_upco_table WHERE status='not_tend' AND app_date='{$current_date}'");
if(mysqli_num_rows($select_appointment) > 0){
 
    while($row = mysqli_fetch_assoc($select_appointment)){
        echo '
        <div class="app-list-single">
        <label class="name-avatar"><i class="fa-solid fa-hospital-user"></i><span>'.$row["patient_name"].'</span></label>
        <small>'.$row["app_start"].' - '.$row["app_end"].'</small>
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