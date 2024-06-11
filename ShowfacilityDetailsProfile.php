<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");

if(!isset($_COOKIE['text_role_hms']) && !isset($_COOKIE['text_mail_hms'])){
header("Location:  Login.php");
}

$_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
$_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];

$session_user=$_SESSION['text_mail_hms'];
$session_role=$_SESSION['text_role_hms'];

// if($session_role != "admin" && $session_role != "doctor" && $session_role != "nurse"){
//   header("Location: accessPage.php");
// }

   






$select_facility_det = mysqli_query($conn, "SELECT * FROM facility_data LIMIT 1");
if(mysqli_num_rows($select_facility_det) > 0){
  $row = mysqli_fetch_assoc($select_facility_det);

  echo '
  <label><strong>Name: </strong><span>'.$row["name"].'</span></label>
  <label><strong>Email: </strong><span>'.$row["email"].'</span></label>
  <label><strong>Contact: </strong><span>'.$row["contact"].'</span></label>
  <label><strong>Address: </strong><span>'.$row["address"].'</span></label>

';


}else{
echo '
<div class="not-data-sec">
<h3>Facility Profile Not Added...</h3>
</div>
';
}
echo '<div class="btn-opps">';

if($session_role == "admin"){

  echo '<button class="btn-add-facility" onclick="addfacilitycont();"><i class="fa-solid fa-house"></i>Add Facility Profile</button>
  <button class="btn-edit-facility" onclick=" changeFacilityDetFields(); editfacilitycont(); "><i class="fa-solid fa-edit"></i>Edit Facility Profile</button>';

}else{
  echo '<button class="btn-add-facility"><i class="fa-solid fa-house"></i>Add Facility Profile</button>
  <button class="btn-edit-facility"><i class="fa-solid fa-edit"></i>Edit Facility Profile</button>';
}



echo '</div>';

?>