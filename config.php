<?php
$conn=mysqli_connect('localhost','root','Mida!2022','hpt_mage_sys_data');

if(!$conn){
    echo "seems we are not conected to our database";
    header("Location: no_database.php");
}
?>