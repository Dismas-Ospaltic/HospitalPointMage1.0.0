<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");

// select user
if(!isset($_COOKIE['text_role_hms']) && !isset($_COOKIE['text_mail_hms'])){
    header("Location:  Login.php");
    }
    
    $_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
    $_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];
    
    $session_user=$_SESSION['text_mail_hms'];
    $session_role=$_SESSION['text_role_hms'];
    
    if($session_role == "admin"){
    $select_admin_det = mysqli_query($conn, "SELECT * FROM admin_data WHERE email_address='{$session_user}'");
    if(mysqli_num_rows($select_admin_det) > 0){
      $row = mysqli_fetch_assoc($select_admin_det);
      $role = $row["role"];
      $adminName = $row["first_name"]." - ".$role;
     
    }else{
        $adminName = "no log";
    }
    }else{
      $select_other_det = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address='{$session_user}'");
    if(mysqli_num_rows($select_other_det) > 0){
      $row = mysqli_fetch_assoc($select_other_det);
      $role = $row["role"];
      $adminName = $row["first_name"]." - ".$role;
    }else{
        $adminName = "no log";
    }
    }

 
$user = $adminName;





$text_name= $_POST["text_name"];
$text_code= $_POST["text_code"];
$text_qty= $_POST["text_qty"];
$text_price=$_POST["text_price"];
$text_dept=$_POST["text_dept"];
$txt_description=$_POST["txt_description"];



$san_text_name=mysqli_real_escape_string($conn, $text_name);
$san_text_code=mysqli_real_escape_string($conn, $text_code);
 $san_text_qty=mysqli_real_escape_string($conn, $text_qty);
 $san_text_price=mysqli_real_escape_string($conn, $text_price);
 $san_text_dept=mysqli_real_escape_string($conn, $text_dept);
 $san_txt_description=mysqli_real_escape_string($conn, $txt_description);


 $ifExists = false;
$select_row_unique = mysqli_query($conn, "SELECT * FROM equipment_data WHERE product_name = '{$text_name}'");
if (mysqli_num_rows($select_row_unique) > 0) {  
    $ifExists = true;
}else{
    $ifExists = false;
}


if(!empty($san_text_qty) && !empty($san_text_code) && !empty($san_text_name)){

    if(!$ifExists){
       $insert_new_Equip = mysqli_query($conn, "INSERT INTO equipment_data(product_name,serial_no,qty,price,department,description_pro,user_add) 
       VALUES('{$san_text_name}','{$san_text_code}','{$san_text_qty}','{$san_text_price}','{$san_text_dept}','{$san_txt_description}','{$user}')");
       
       if($insert_new_Equip){
       echo "added successfully";
       }else{
       echo "failed";
       }
   }else{
       echo "equip exists";
   }
   
   
   }else{
       echo "empty fields";
   }





?>