<?php
@include 'config.php';

$select_count= mysqli_query($conn, "SELECT COUNT(*) FROM laboratory_test WHERE status='not_tested'");
$number_row = mysqli_fetch_array($select_count);
$total_count= $number_row[0];

echo $total_count;


?>