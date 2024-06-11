<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

 $select_medical_hist = mysqli_query($conn, "SELECT p_med_hist FROM patient_details WHERE hospital_patient_no ='{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");

if(mysqli_num_rows($select_medical_hist) > 0){
$row = mysqli_fetch_assoc($select_medical_hist);
if(!empty($row["p_med_hist"])){

    $res1=$row['p_med_hist'];
    $res1=explode(";",$res1);
    $count1=count($res1)-1;

    for($i=0; $i<=$count1;$i++){
      $split_med_hist=$res1[$i];
      echo '
      <p>'.$split_med_hist.'</p>
      ';
    }

}else{
    echo '
    <section id="no-det">
    <h3>No Data Available...</h3>
  </section>
    ';
}

}

}else{
    echo "not set";
}
?>