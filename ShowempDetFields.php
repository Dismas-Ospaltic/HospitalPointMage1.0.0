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
    <input type="text" name="text_lname" placeholder="please enter lastname..." value="'.$row["last_name"].'">
   </div>

   <div class="input-wrapper">
    <label>Email *</label>
    <input type="text" name="text_mail" placeholder="please enter Email address..." value="'.$email_address.'">
   </div>



   <div class="input-wrapper">
    <label>Phone*</label>
    <input type="text" name="text_phone" placeholder="please enter Phone No..." value="'.$phone.'">
   </div>

 
   <div class="btn-wrapper">
    <button class="btn-save-update" onclick="UpdateUserProfile();">Save</button>
   </div>
   </form>
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