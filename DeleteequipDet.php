<?php
@include 'config.php';
if(isset($_GET["name"]) && isset($_GET["proid"])){

$name = mysqli_real_escape_string($conn, $_GET["name"]) ;
$proid = mysqli_real_escape_string($conn, $_GET["proid"]) ;
$DELETE_single_det = mysqli_query($conn, "DELETE FROM equipment_data WHERE product_name='{$name}' AND id='{$proid}'");

if($DELETE_single_det){
    echo "deleted";
}else{
    echo "failed";
}
}