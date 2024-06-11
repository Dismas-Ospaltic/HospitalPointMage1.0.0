<?php
@include 'config.php';

if(isset($_GET["email"])){
$EMAIL=mysqli_real_escape_string($conn, $_GET["email"]);
$select_quiz = mysqli_query($conn, "SELECT security_quiz FROM admin_data WHERE email_address='{$EMAIL}'");

if(mysqli_num_rows($select_quiz) > 0){
$row = mysqli_fetch_assoc($select_quiz);
if(!empty($row["security_quiz"])){
    echo $row["security_quiz"];
}else{
    echo "Sorry You Did not Set Security Qestion for Your Account, Seek Help From System Admin!";
}


}else{
// echo "no data";

$select_quiz = mysqli_query($conn, "SELECT security_quiz FROM employee_data WHERE email_address='{$EMAIL}'");

if(mysqli_num_rows($select_quiz) > 0){
$row = mysqli_fetch_assoc($select_quiz);
if(!empty($row["security_quiz"])){
    echo $row["security_quiz"];
}else{
    echo "Sorry You Did not Set Security Qestion for Your Account, Seek Help From System Admin!";
}

}else{
    echo "This Account Does not Exist!"; 
}

}
}else{
    echo "not set";
}
?>