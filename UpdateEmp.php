<?php
@include 'config.php';

if(isset($_GET["mail"])){

$EMAIL= mysqli_real_escape_string($conn, $_GET["mail"]);


$text_fname= $_POST["text_fname"];
$text_mname= $_POST["text_mname"];
$text_lname= $_POST["text_lname"];
$text_idno=$_POST["text_idno"];
$text_gender=$_POST["text_gender"];
$text_mail=$_POST["text_email"];
$text_phone=$_POST["text_phone"];
$text_role=$_POST["text_role"];
$text_dept=$_POST["text_dept"];
$text_staff=$_POST["text_staff"];
// $pass_key = $_POST["text_passkey"];


$san_text_fname=mysqli_real_escape_string($conn, $text_fname);
$san_text_mname=mysqli_real_escape_string($conn, $text_mname);
 $san_text_lname=mysqli_real_escape_string($conn, $text_lname);
 $san_text_idno=mysqli_real_escape_string($conn, $text_idno);
 $san_text_gender=mysqli_real_escape_string($conn, $text_gender);
 $san_text_mail=mysqli_real_escape_string($conn, $text_mail);
 $san_text_phone=mysqli_real_escape_string($conn, $text_phone);
 $san_text_role=mysqli_real_escape_string($conn, $text_role);
 $san_text_dept=mysqli_real_escape_string($conn, $text_dept);
 $san_text_staff=mysqli_real_escape_string($conn, $text_staff);



 $ifExists = false;


$select_row_unique = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address = '{$san_text_mail}'");
if (mysqli_num_rows($select_row_unique) > 0) {  
    
    
    $row_exist = mysqli_fetch_assoc($select_row_unique);
    $mail_exist = $row_exist["email_address"];
    if($mail_exist == $EMAIL){
        $ifExists = false;
    }else{
     $ifExists = true;
    }

}else{
    $ifExists = false;
}



if(!empty($text_fname) && !empty($text_lname) && !empty($text_mail) && !empty($text_phone) && !empty($text_role) && !empty($text_idno)){

    if(!$ifExists){
       $update_emp = mysqli_query($conn, "UPDATE employee_data SET first_name='{$san_text_fname}',middle_name='{$san_text_mname}',last_name='{$san_text_lname}',email_address='{$san_text_mail}',contact='{$san_text_phone}',role='{$san_text_role}',gender='{$san_text_gender}',national_id='{$san_text_idno}',dept='{$san_text_dept}',staff_no='{$san_text_staff}'");
       
       if($update_emp){
       echo "added successfully";
       }else{
       echo "failed";
       }
   }else{
       echo "emp exists";
   }
   
   }else{
       echo "empty fields";
   }








}else{
    echo "not set";
}
?>