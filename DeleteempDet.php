<?php
@include 'config.php';
if(isset($_GET["mail"])){

$mail = mysqli_real_escape_string($conn, $_GET["mail"]) ;
$DELETE_single_det = mysqli_query($conn, "DELETE FROM employee_data WHERE email_address='{$mail}'");

if($DELETE_single_det){
    echo "deleted";
}else{
    echo "failed";
}


}else{
    echo "not set";
}
?>