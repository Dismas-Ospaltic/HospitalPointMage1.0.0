<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

   $select_patient_data_card = mysqli_query($conn, "SELECT * FROM patient_details WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");

   if(mysqli_num_rows($select_patient_data_card) > 0){
    $row = mysqli_fetch_assoc($select_patient_data_card);
   echo '
   <div class="left-card">
   <div id="avatar-name-age">
   <img src="resources/img/patient.jpg">
   <label>
     <p><strong>'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</strong></p>
     <p>'.$row["age"].' years old<span id="gender">'.$row["gender"].'</span></p>
   </label>
   </div>
   <div id="height-weight-blood">
   <label>

    <p><small>Height</small></p>';
    if(!empty($row["height"])){
      echo ' <p>'.$row["height"].'</p>';
    }else{
        echo ' <p>---</p>';
    }
    
   echo '</label>
    
   <label>
     <p><small>Weight</small></p>';
     if(!empty($row["weight"])){
     echo '<p>'.$row["weight"].'</p>';
     }else{
        echo '<p>---</p>';
     }

  echo '</label>
   
   <label>
     <p><small>Blood Type</small></p>';
     if(!empty($row["p_blood_type"])){
     echo '<p>'.$row["p_blood_type"].'</p>';
     }else{
        echo '<p>---</p>';
     }

   echo '</label>
   
   </div>
   </div>
   <div class="right-card">
   <div id="other-det">
     <div class="other-det-container">
   <label>
     <p><small>Phone</small></p>
     <p>'.$row["phone"].'</p>
   </label>
    
   <label>
     <p><small>email</small></p>';
     if(!empty($row["email"])){
     echo '<p>'.$row["email"].'</p>';
     }else{
        echo '<p>---</p>';
     }

   echo '</label>
   </div>
   
   <div class="other-det-container">
     <label>
       <p><small>Residence</small></p>';
       if(!empty($row["residence"])){
       echo '<p>'.$row["residence"].'</p>';
       }else{
        echo '<p>---</p>';
       }

    echo '</label>
      
     <label>
       <p><small>National Id</small></p>';
       if(!empty($row["nid"])){
       echo '<p>'.$row["nid"].'</p>';
       }else{
        echo '<p>---</p>';
       }

     echo '</label>
     </div>
   
     <div class="other-det-container">
       <label>
         <p><small>Hospital Patient No.</small></p>
         <p>'.$row["hospital_patient_no"].'</p>
       </label>
        
       <label>
         <p><small>IDP / ODP No</small></p>
         <p>'.$row["odp_idp_no"].'</p>
       </label>
       </div>
   
       <div class="other-det-container">
         <label>
           <p><small>Insurance company</small></p>';
           if(!empty($row["insurance_comp"])){
           echo '<p>'.$row["insurance_comp"].'</p>';
           }else{
            echo '<p>---</p>';
           }
 
        echo '</label>
          
         <label>
           <p><small>Insurance Member No.</small></p>';
           if(!empty($row["insurance_no"])){
           echo '<p>'.$row["insurance_no"].'</p>';
           }else{
            echo '<p>---</p>';
           }
        echo '</label>
         </div>

   </div>
   </div>
   ';
    
   }
   else{
   echo 'No Data!';
   }

}else{
    echo "not Set";
}
?>
