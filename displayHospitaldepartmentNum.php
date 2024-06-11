<?php
@include 'config.php';
$current_date = date("Y-m-d");

$select_count= mysqli_query($conn, "SELECT COUNT(*) FROM department_data");
$number_row = mysqli_fetch_array($select_count);
$total_count= $number_row[0];

echo $total_count;

?>