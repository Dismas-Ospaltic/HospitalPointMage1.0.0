<?php
@include 'config.php';

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
//  $san_pass_key = mysqli_real_escape_string($conn, $pass_key);


$ifExists = false;


$select_row_unique = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address = '{$san_text_mail}'");
if (mysqli_num_rows($select_row_unique) > 0) {  
    $ifExists = true;
}else{
    $ifExists = false;
}





if(!empty($text_fname) && !empty($text_lname) && !empty($text_mail) && !empty($text_phone) && !empty($text_role) && !empty($text_idno)){

 if(!$ifExists){
    $insert_new_emp = mysqli_query($conn, "INSERT INTO employee_data(first_name,middle_name,last_name,email_address,contact,role,gender,national_id,dept,staff_no) 
    VALUES('{$san_text_fname}','{$san_text_mname}','{$san_text_lname}','{$san_text_mail}','{$san_text_phone}','{$san_text_role}','{$san_text_gender}','{$san_text_idno}','{$san_text_dept}','{$san_text_staff}')");
    
    if($insert_new_emp){
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
 


?>