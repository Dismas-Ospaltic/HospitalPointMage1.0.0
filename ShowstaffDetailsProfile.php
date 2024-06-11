<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");

if(isset($_COOKIE['text_role_hms']) && isset($_COOKIE['text_mail_hms'])){


$_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
$_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];

$session_user=$_SESSION['text_mail_hms'];
$session_role=$_SESSION['text_role_hms'];

if($session_role == "admin"){
$select_admin_det = mysqli_query($conn, "SELECT * FROM admin_data WHERE email_address='{$session_user}'");
if(mysqli_num_rows($select_admin_det) > 0){
  $row = mysqli_fetch_assoc($select_admin_det);
  $adminName = $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
  $role = $row["role"];
   $email_address = $row["email_address"];
   $phone = $row["contact"];

echo '
<label><strong>Name: </strong><span>'.$adminName.'</span></label>
<label><strong>Email: </strong><span>'.$email_address.'</span></label>
<label><strong>Contact: </strong><span>'.$phone.'</span></label>
<label><strong>Role: </strong><span>'.$role.'</span></label>
<label><strong>Staff No: </strong><span>- - -</span></label>
<label><strong>ID No.: </strong><span>- - -</span></label>
<label><strong>Department: </strong><span>- - -</span></label>

<div class="btn-opps">
<button class="btn-edit" onclick=" changestaffDetFields(); showEditProfile();"><i class="fa-solid fa-edit"></i>Edit Profile</button>
<button class="btn-change" onclick="ChangePassCont();"><i class="fa-solid fa-lock-open"></i>Change Password</button>
</div>
';
   
}else{
echo '
<div class="not-data-sec">
<h3>No Data Available...</h3>
</div>
';
}
}else{
  $select_other_det = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address='{$session_user}'");
if(mysqli_num_rows($select_other_det) > 0){
  $row = mysqli_fetch_assoc($select_other_det);
  $adminName = $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
  $role = $row["role"];
  $email_address = $row["email_address"];
  $phone = $row["contact"];
  $Id = $row["national_id"];
  $staff = $row["staff_no"];
  $department = $row["dept"];



  echo '
  <label><strong>Name: </strong><span>'.$adminName.'</span></label>
  <label><strong>Email: </strong><span>'.$email_address.'</span></label>
  <label><strong>Contact: </strong><span>'.$phone.'</span></label>
  <label><strong>Role: </strong><span>'.$role.'</span></label>
  <label><strong>Staff No: </strong><span>'.$staff.'</span></label>
  <label><strong>ID No.: </strong><span>'.$Id.'</span></label>
  <label><strong>Department: </strong><span>'.$department.'</span></label>
  
  <div class="btn-opps">
  <button class="btn-edit" onclick=""><i class="fa-solid fa-edit"></i>Edit Profile</button>
  <button class="btn-change" onclick="ChangePassCont();"><i class="fa-solid fa-lock-open"></i>Change Password</button>
  </div>
  ';
}else{
echo '
<div class="not-data-sec">
<h3>No Data Available...</h3>
</div>
';
}
}

}else{

echo '
<div class="not-data-sec">
<h3>No Data Available...</h3>
</div>';


}

?>