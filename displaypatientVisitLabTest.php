<?php
@include 'config.php';
$current_date = date("Y-m-d");

if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $VISIT_ID = mysqli_real_escape_string($conn, $_GET["V_ID"]);


   $select_lab_test_res = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE hospital_patient_no ='{$hospital_unique}' AND visit_id ='{$VISIT_ID}' AND status ='tested'");
   
if(mysqli_num_rows($select_lab_test_res) > 0){
$row = mysqli_fetch_assoc($select_lab_test_res);





$res1=$row['sample_list'];
$res2=$row['test_list'];
$res3=$row['test_result'];
$res4=$row['other_conclusion'];

$res1=explode(";",$res1);
$res2=explode(";",$res2);
$res3=explode(";",$res3);
$res4=explode(";",$res4);

$count1=count($res1)-1;
$count2=count($res2)-1;
$count3=count($res3)-1;
$count4=count($res4)-1;
echo '
<div class="main-head">
<h1>Patient lab overview Notes</h1>
</div>
<div class="patient-overview">
<label><h3>Sample No.:</h3><span>'.$row["sample_no"].'</span></label>
<label><strong>Return Time:</strong><span>'.$row["return_time"].' on '.$row["return_date"].'</span></label>
</div>
<div class="det-discharge">
<label><strong>Samples Collected</strong></label>';


for($i=0; $i<=$count1;$i++){
    $split_sample_list=$res1[$i];
    if(!empty($split_sample_list)){
        echo '<p>'.$split_sample_list.'</p>';
    }else{
       echo '<p>data not added ...</p>';  
    }
  }
echo '</div>

<div class="det-discharge">
<label><strong>Tests Done</strong></label>';
for($i=0; $i<=$count2;$i++){
    $split_tests=$res2[$i];

    if(!empty($split_tests)){
        echo '<p>'.$split_tests.'</p>';
    }else{
        echo '<p>data not added ...</p>';   
    }
  }



echo '</div>

<div class="det-discharge">
<label><strong>Test Results</strong></label>';
for($i=0; $i<=$count3;$i++){
    $split_tests_res=$res3[$i];

    if(!empty($split_tests_res)){
        echo '<p>'.$split_tests_res.'</p>';
    }else{
        echo '<p>data not added ...</p>';   
    }
  }


echo '</div>

<div class="det-discharge">
<label><strong>Conclutions And Other Details</strong></label>';

for($i=0; $i<=$count4;$i++){
    $split_tessts_con=$res4[$i];

    if(!empty($split_tessts_con)){
        echo '<p>'.$split_tessts_con.'</p>';
    }else{
        echo '<p>data not added ...</p>';   
    }
  }

echo '</div>
';
}else{
    echo '
    <section id="no-det">
    <h3>No Lab Results has been posted Yet!</h3>
  </section>
    '; 
}
echo '
<div id="man-water-mark">
<label><small>This system was designed by </small><span>Ospaltic Software Solutions</span></label>
<label><small><i class="fa-solid fa-phone"></i>Contact: </small><span>+254742354784, +254736218327</span></label>
<label><small><i class="fa-solid fa-envelope"></i>Email: </small><span>ospaltic@gmail.com</span></label>
<label><small><i class="fa-solid fa-f"></i>facebook: </small><span>Ospaltic</span></label>
</div>
';


}else{
    echo "not set";
}
   ?>