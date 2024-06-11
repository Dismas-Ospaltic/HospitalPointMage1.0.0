<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
//    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
//    $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);


echo '
<form action="#" method="post">
<p><strong>Note: use semi-colon (;) at end of each statement to separate lines *</strong></p>
<div class="input-wrapper">
<label>Medical History *</label>
<textarea  name="text_med_hist" placeholder="patient medical History. Allergies, Sex life etc..."></textarea>
</div>

<div class="btn-wrapper">
<button class="save-btn" onclick="AddMedicalHistory();"><i class="fa-solid fa-plus"></i>Save Changes</button>
</div>
</form>
';


}else{
    echo "not set";
}
?>