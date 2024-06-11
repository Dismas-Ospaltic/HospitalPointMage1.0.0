<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

   $select_patient_data_card = mysqli_query($conn, "SELECT * FROM patient_details WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");
      
   if(mysqli_num_rows($select_patient_data_card) > 0){
    $row = mysqli_fetch_assoc($select_patient_data_card);
    $HPT_reg = $row['hospital_patient_no'];
    $DEPT_NO = $row['odp_idp_no'];
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
     if(!empty($row["p_weight"])){
     echo '<p>'.$row["p_weight"].'</p>';
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
   <h4>Medical History</h4>
   <p>';
    if(!empty($row["p_med_hist"])){
      $res1=$row['p_med_hist'];
      $res1=explode(";",$res1);
      $count1=count($res1)-1;
      for($i=0; $i<=$count1;$i++){
        $split_med_hist=$res1[$i];
        echo $split_med_hist.'<br>';
      }
   }else{
    echo '
    </p>
    <section id="no-det">
    <h3>No Data Available...</h3>
  </section>
    ';
   }

   echo '<div class="btns-opp"> 
       <button class="btn-read" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$HPT_reg.'&ODPIDP='.$DEPT_NO.'\'); displaymoreDetMedHist(); displayMedHistmoreDetContainer();"><i class="fa-solid fa-info-circle"></i>Read More</button>
       <button class="btn-add" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$HPT_reg.'&ODPIDP='.$DEPT_NO.'\'); displayWindowAddMedicalHistNew(); displayMedHistContainerAddNew();"><i class="fa-solid fa-stethoscope"></i>Add Medical History</button>
       <button class="btn-edit" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/doctorpatient.php?HSPN='.$HPT_reg.'&ODPIDP='.$DEPT_NO.'\'); displayWindowAddMedical(); displayMedHistContainer();"><i class="fa-solid fa-edit"></i>Edit Medical History</button>
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
