<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
    $VISIT_ID  = mysqli_real_escape_string($conn, $_GET["V_ID"]);
    $HPT_NO = mysqli_real_escape_string($conn, $_GET["HSPN"]);

   
 $select_Incoming = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE hospital_patient_no='{$HPT_NO}' AND visit_id='{$VISIT_ID}' AND status='tested'");
if(mysqli_num_rows($select_Incoming) > 0){
    $data1 = mysqli_fetch_assoc($select_Incoming);


    $res1=$data1['sample_list'];
    $res2=$data1['test_specification'];
    $res3=$data1['other_specification'];
    $res4=$data1['sample_col'];
    $res5=$data1['test_list'];
    $res6=$data1['test_result'];
    $res7=$data1['other_conclusion'];
 
    $res1=explode(";",$res1);
    $res2=explode(";",$res2);
    $res3=explode(";",$res3);
    $res4=explode(";",$res4);
    $res5=explode(";",$res5);
    $res6=explode(";",$res6);
    $res7=explode(";",$res7);
 
    $count1=count($res1)-1;
    $count2=count($res2)-1;
    $count3=count($res3)-1;
    $count4=count($res4)-1;
    $count5=count($res5)-1;
    $count6=count($res6)-1;
    $count7=count($res7)-1;
 
echo '
<div id="discharge-lab-comp">
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
 

<div class="main-head">
<h1>Patient lab Test Results</h1>
</div>

<div class="patient-overview">
<label><h3>Lab Tech:</h3><span>'.$data1["lab_tech"].'</span></label>
<label><strong>Return Date:</strong><span>'.$data1["return_date"].' at '.$data1["return_time"].'</span></label>
<label><h3>Sample No:</h3><span>'.$data1["sample_no"].'</span></label>
</div>

<div class="det-discharge">
<label><strong>Samples Collected</strong></label>';

 for($i=0; $i<=$count4;$i++){
    $split_samp_col=$res4[$i];
    if(!empty($split_samp_col)){
        echo '<p>'.$split_samp_col.'</p>';
    }else{
       echo '<p>no data...</p> ';  
    }
  }
echo '</div>

<div class="det-discharge">
<label><strong>Tests Done</strong></label>';

 for($i=0; $i<=$count5;$i++){
    $split_test_list=$res5[$i];
    if(!empty($split_test_list)){
        echo '<p>'.$split_test_list.'</p>';
    }else{
       echo '<p>no data...</p> ';  
    }
  }
echo '</div>

<div class="det-discharge">
<label><strong>Test Results</strong></label>';
 for($i=0; $i<=$count6;$i++){
    $split_test_result=$res6[$i];
    if(!empty($split_test_result)){
        echo '<p>'.$split_test_result.'</p>';
    }else{
       echo '<p>no data...</p> ';  
    }
  }
echo '</div>

<div class="det-discharge">
<label><strong>Other Details</strong></label>';

for($i=0; $i<=$count7;$i++){
    $split_other_con=$res7[$i];
    if(!empty($split_other_con)){
        echo '<p>'.$split_other_con.'</p>';
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