<?php
@include 'config.php';


if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
    $VISIT_ID  = mysqli_real_escape_string($conn, $_GET["V_ID"]);
    $HPT_NO = mysqli_real_escape_string($conn, $_GET["HSPN"]);

$select_Incoming = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE hospital_patient_no='{$HPT_NO}' AND visit_id='{$VISIT_ID}'");
if(mysqli_num_rows($select_Incoming) > 0){
$row = mysqli_fetch_assoc($select_Incoming);
echo '
<form action="#" method="post">
<p><strong>Note: use semi-colon (;) at end of each statement to separate lines *</strong></p>

<div class="input-wrapper">
    <label>Sample No. *</label>
    <input type="text" name="text_sampleno" placeholder="enter sample no..." value="'.$row["sample_no"].'">
   </div>

<div class="input-wrapper">
<label>Samples *</label>
<textarea  name="samle_list" placeholder="Specify the samples you collected e.g blood, urine etc...">'.$row["sample_col"].'</textarea>
</div>

<div class="input-wrapper">
<label>Tests *</label>
<textarea name="text_test" placeholder="List the tests Conducted...">'.$row["test_list"].'</textarea>
</div>

<div class="input-wrapper">
<label>Tests Results *</label>
<textarea name="test_result" placeholder="List the test Results...">'.$row["test_result"].'</textarea>
</div>

<div class="input-wrapper">
<label>Other Additional details</label>
<textarea name="text_info" placeholder="Any other additional info here...">'.$row["other_conclusion"].'</textarea>
</div>

<div class="btn-wrapper">
<button class="save-btn" onclick="AddLabTestResult()"><i class="fa-solid fa-plus"></i>Save Changes</button>
</div>
</form>
';

}

}else{
    echo "not set";
}
?>