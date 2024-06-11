<?php
@include 'config.php';

$select_count= mysqli_query($conn, "SELECT COUNT(*) FROM app_upco_table WHERE status='not_tend'");
$number_row = mysqli_fetch_array($select_count);
$total_count= $number_row[0];

echo $total_count;

?>