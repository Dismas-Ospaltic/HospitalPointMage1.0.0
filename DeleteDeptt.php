<?php
@include 'config.php';
if(isset($_GET["dept_name"])){

$dept_name = mysqli_real_escape_string($conn, $_GET["dept_name"]) ;
$deptid = mysqli_real_escape_string($conn, $_GET["deptid"]) ;

$DELETE_single_det = mysqli_query($conn, "DELETE FROM department_data WHERE dept_name='{$dept_name}' AND id='{$deptid}'");

if($DELETE_single_det){
    echo "deleted";
}else{
    echo "failed";
}


}else{
    echo "not set";
}

?>