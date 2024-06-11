<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
    $VISIT_ID  = mysqli_real_escape_string($conn, $_GET["V_ID"]);
    $HPT_NO = mysqli_real_escape_string($conn, $_GET["HSPN"]);

   
 $select_Incoming = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE hospital_patient_no='{$HPT_NO}' AND visit_id='{$VISIT_ID}' AND status='not_tested'");
if(mysqli_num_rows($select_Incoming) > 0){
    $data1 = mysqli_fetch_assoc($select_Incoming);


    $res1=$data1['sample_list'];
    $res2=$data1['test_specification'];
    $res3=$data1['other_specification'];
    // $res4=$data1['medication'];
 
    $res1=explode(";",$res1);
    $res2=explode(";",$res2);
    $res3=explode(";",$res3);
    // $res4=explode(";",$res4);
 
    $count1=count($res1)-1;
    $count2=count($res2)-1;
    $count3=count($res3)-1;
    // $count4=count($res4)-1;


echo '
<div id="discharge">
<div class="main-head">
  <h1>Patient lab Test Order</h1>
</div>
<div class="patient-overview">
 <label><h3>Doctor.:</h3><span>'.$data1["sent_by"].'</span></label>
 <label><strong>Request Date:</strong><span>'.$data1["request_date"].' at '.$data1["request_time"].'</span></label>
</div>
<div class="det-discharge">
 <label><strong>Samples List to Collected</strong></label>';


 for($i=0; $i<=$count1;$i++){
    $split_samples=$res1[$i];

    if(!empty($split_samples)){
        echo '<p>'.$split_samples.'</p>';
    }else{
       echo '<p>no data...</p> ';  
    }
  }


echo '</div>

<div class="det-discharge">
<label><strong>Tests Specifications</strong></label>';


for($i=0; $i<=$count2;$i++){
    $split_testlist=$res2[$i];

    if(!empty($split_testlist)){
        echo '<p>'.$split_testlist.'</p>';
    }else{
       echo '<p>no data...</p> ';  
    }
  }

echo '</div>

<div class="det-discharge">
<label><strong>Other Details</strong></label>';

 for($i=0; $i<=$count3;$i++){
    $split_otherspec=$res3[$i];

    if(!empty($split_otherspec)){
        echo '<p>'.$split_otherspec.'</p>';
    }else{
       echo '<p>no data...</p> ';  
    }
  }
echo '</div>


<div id="man-water-mark">
<label><small>This system was designed by </small><span>Ospaltic Software Solutions</span></label>
<label><small><i class="fa-solid fa-phone"></i>Contact: </small><span>+254742354784, +254736218327</span></label>
<label><small><i class="fa-solid fa-envelope"></i>Email: </small><span>ospaltic@gmail.com</span></label>
<label><small><i class="fa-solid fa-f"></i>facebook: </small><span>Ospaltic</span></label>
</div>
</div>
';
}else{
 echo "nothing to show...";
}
}else{
    echo "not set";
}
?>