<?php
@include 'config.php';
$current_date = date("Y-m-d");


    $select_facility_det = mysqli_query($conn, "SELECT * FROM facility_data LIMIT 1");
    if(mysqli_num_rows($select_facility_det) > 0){
      $row = mysqli_fetch_assoc($select_facility_det);

    echo '
    <form action="#" method="post">
    <div class="input-wrapper">
    <label>Facility Name *</label>
    <input type="text" name="text_name" placeholder="please enter facility name..." value="'.$row["name"].'">
   </div>

   <div class="input-wrapper">
    <label>Email*</label>
    <input type="text" name="text_mail" placeholder="please enter email..." value="'.$row["email"].'">
   </div>

   <div class="input-wrapper">
    <label>Contact *</label>
    <input type="text" name="text_contact" placeholder="please enter contact details..." value="'.$row["contact"].'">
   </div>

   <div class="input-wrapper">
    <label>Address *</label>
    <input type="text" name="text_address" placeholder="please enter address..." value="'.$row["address"].'">
   </div>


  <div class="btn-wrapper">
   <button class="btn-save-update" onclick="UpdateFacilityProfile();">Save</button>
   </div>
   </form>
    ';
       
    }else{
    echo '
    <div class="not-data-sec">
    <h3>No Data Available...</h3>
    </div>
    ';
    }
    


    
    ?>