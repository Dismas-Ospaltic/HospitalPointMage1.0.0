<?php
session_start();
@include 'config.php';



if(isset($_GET["mail"])){

  $mail = mysqli_real_escape_string($conn, $_GET["mail"]) ;
  $select_single_det = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address='{$mail}'");
  if (mysqli_num_rows($select_single_det) > 0) {  
  $row = mysqli_fetch_assoc($select_single_det);

  echo '
  <form action="#" method="post">
  <div class="input-wrapper">
  <label>First Name *</label>
  <input type="text" name="text_fname" placeholder="please enter first name..." value="'.$row["first_name"].'">
 </div>

 <div class="input-wrapper">
  <label>Middle Name</label>
  <input type="text" name="text_mname" placeholder="please enter middle name..." value="'.$row["middle_name"].'">
 </div>

 <div class="input-wrapper">
  <label>Last Name *</label>
  <input type="text" name="text_lname" placeholder="please enter last name..." value="'.$row["last_name"].'">
 </div>


 <div class="input-wrapper">
  <label>National ID *</label>
  <input type="text" name="text_idno" placeholder="please enter number of national document..." value="'.$row["national_id"].'">
 </div>';



 echo '<div class="input-wrapper">
  <label>Gender</label>
  <select name="text_gender">';

  if(!empty($row["gender"])){
echo '<option value="'.$row["gender"].'">'.$row["gender"].'</option>';
  }
  echo'
<option value="">--Select Gender--</option>
<option value="male">Male</option>
<option value="female">Female</option>
  </select>
 </div> 

 <div class="input-wrapper">
  <label>email Address *</label>
  <input type="text" name="text_email" placeholder="please enter email address..." value="'.$row["email_address"].'">
 </div>


 <div class="input-wrapper">
  <label>Phone No. *</label>
  <input type="text" name="text_phone" placeholder="please enter Phone number..." value="'.$row["contact"].'">
 </div>';

 echo '<div class="input-wrapper">
  <label>Role *</label>
  <select name="text_role">';
  if(!empty($row["role"])){
   echo '<option  value="'.$row["role"].'">'.$row["role"].'</option>';
   }
  echo'
<option value="">--Select Role--</option>
<option value="doctor">Doctor</option>
<option value="nurse">Nurse</option>
<option value="reception">Reception</option>
<option value="Lab Tech">Lab Tech</option>
  </select>
 </div> 


 <div class="input-wrapper">
 <label>Department</label>
 <select name="text_dept">';
 if(!empty($row["dept"])){
    echo '<option  value="'.$row["dept"].'">'.$row["dept"].'</option>';
    }
$selcect_dept_data = mysqli_query($conn, "SELECT * FROM department_data");
echo '<option value="">--Select Department--</option>';
if(mysqli_num_rows($selcect_dept_data) > 0){
while($row = mysqli_fetch_assoc($selcect_dept_data)){
echo '<option value="'.$row["dept_name"].'">'.$row["dept_name"].'</option>';
}
}else{
echo '<option value="">--Department Not Added--</option>';
}
echo '</select>
</div>


<div class="input-wrapper">
 <label>Staff No.</label>
 <input type="text" name="text_staff" placeholder="please enter Staff No..." value="'.$row["staff_no"].'">
</div>

 <div class="btn-wrapper">
  <button class="emp-save" onclick="UpdateEmp()" >Save</button>
 </div>
</form>
  ';




  }
}else{
    echo "not set";
}

?>