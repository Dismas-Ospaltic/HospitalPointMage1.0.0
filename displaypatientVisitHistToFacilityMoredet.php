<?php
@include 'config.php';
$tend ="tend";
if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $VISIT_ID = mysqli_real_escape_string($conn, $_GET["V_ID"]);

   $select_visits_det =mysqli_query($conn, "SELECT * FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND status='{$tend}' AND visit_id='{$VISIT_ID}'");

   if(mysqli_num_rows($select_visits_det) > 0){
   $row = mysqli_fetch_assoc($select_visits_det);
 
  echo '
  <div class="visit-det-cont">
  <div class="single-wraper-label">
    <label><strong>Visit: </strong><span>'.$row["visit"].'</span></label>
    <label><strong>Visit Id: </strong><span>'.$row["visit_id"].'</span></label>
  </div>

  <div class="single-wraper-label">
    <label><strong>Visit Reason: </strong><span>'.$row["visit_reason"].'</span></label>
    <label><strong>Department: </strong><span>'.$row["department"].'</span></label>
  </div>

  <div class="single-wraper-label">
    <label><strong>Visit date: </strong><span>'.$row["visit_date"].'</span></label>
    <label><strong>discharge date: </strong><span>'.$row["discharge_date"].'</span></label>
  </div>

  
  <div class="single-wraper-label">
    <label><strong>Visit Type: </strong><span>'.$row["visit_type"].'</span></label>
    <label><strong>tend By: </strong><span>'.$row["tend_by"].'</span></label>
  </div>

  <div class="single-wraper-more">
    <label><strong>Cheif Complaint: </strong></label>';
   
    if(!empty($row["cheif_complaint"])){

        $select_cheif_complaint = mysqli_query($conn, "SELECT cheif_complaint FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND status='{$tend}' AND visit_id='{$VISIT_ID}'");
        $data1=mysqli_fetch_array($select_cheif_complaint);
        $res1=$data1['cheif_complaint'];

        $res1=explode(";",$res1);

        $count1=count($res1)-1;
   
        for($i=0; $i<=$count1;$i++){
         $split_cheif_complait=$res1[$i];

         echo '<label><p>'.$split_cheif_complait.'</p></label>';
       }
    }
      echo '</div>

  <div class="single-wraper-more">
    <label><strong>Doctor\'s Notes: </strong></label>';


    if(!empty($row["doctor_note"])){

        $select_doc_note = mysqli_query($conn, "SELECT doctor_note FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND status='{$tend}' AND visit_id='{$VISIT_ID}'");
        $data2=mysqli_fetch_array($select_doc_note);
        $res2=$data2['doctor_note'];

        $res2=explode(";",$res2);

        $count2=count($res2)-1;
   
        for($i=0; $i<=$count2;$i++){
         $split_doctor_note=$res2[$i];

         echo '<label><p>'.$split_doctor_note.'</p></label>';
       }
    }
    // <label><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
    //   Eaque laborum qui dolore corrupti. Adipisci assumenda repudiandae dolorum 
    //   error architecto libero perspiciatis deleniti,
    //    magni maxime reiciendis est placeat sequi vel molestiae.</p></label>
  
    echo '</div>
  <div class="single-wraper-more">
    <label><strong>Diagnosis: </strong></label>';

    if(!empty($row["diagnosis"])){

        $select_diadnosis = mysqli_query($conn, "SELECT diagnosis FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND status='{$tend}' AND visit_id='{$VISIT_ID}'");
        $data3=mysqli_fetch_array($select_diadnosis);
        $res3=$data3['diagnosis'];

        $res3=explode(";",$res3);

        $count3=count($res3)-1;
   
        for($i=0; $i<=$count3;$i++){
         $split_diagnosis=$res3[$i];

         echo '<label><p>'.$split_diagnosis.'</p></label>';
       }
    }
    // <label><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
    //   Eaque laborum qui dolore corrupti. Adipisci assumenda repudiandae dolorum 
    //   error architecto libero perspiciatis deleniti,
    //    magni maxime reiciendis est placeat sequi vel molestiae.</p></label>


 echo '</div>

  <div class="single-wraper-more">
    <label><strong>Treatment And Medication: </strong></label>';

    if(!empty($row["medication"])){

        $select_medication = mysqli_query($conn, "SELECT medication FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND status='{$tend}' AND visit_id='{$VISIT_ID}'");
        $data4=mysqli_fetch_array($select_medication);
        $res4=$data4['medication'];

        $res4=explode(";",$res4);

        $count4=count($res4)-1;
   
        for($i=0; $i<=$count4;$i++){
         $split_medication=$res4[$i];

         echo '<label><p>'.$split_medication.'</p></label>';
       }
    } 
    //   <label><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
    //   Eaque laborum qui dolore corrupti. Adipisci assumenda repudiandae dolorum 
    //   error architecto libero perspiciatis deleniti,
    //    magni maxime reiciendis est placeat sequi vel molestiae.</p></label>


  echo '</div>
 <div class="opp-btns-visit-hist">
  <button class="print-dis-view" onclick="window.open(\'printdischarge.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\', \'_blank\')">print discharge summary</button>
 </div>
  </div>
  ';
   
   }else{
    echo "no data to show...";
   }

}else{
    echo "not set";
}


?>