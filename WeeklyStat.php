<?php

@include 'config.php';

// Get the earliest sale date from the database
$query = "SELECT MIN(visit_date) AS earliest_date FROM patient_sub_visit";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$earliestDate = $row['earliest_date'];
 
// Get the current date and year
$currentDate = date('Y-m-d');
$currentYear = date('Y');

// Calculate the start and end dates for each week
$startDates = array();
$endDates = array();
$week = 1;
$startDate = $earliestDate;

while ($startDate <= $currentDate) {
    $endDate = date("Y-m-d", strtotime("{$startDate} +6 days"));

    // Store the start and end dates for each week
    $startDates[$week] = $startDate;
    $endDates[$week] = $endDate;

    $week++;
    $startDate = date("Y-m-d", strtotime("{$endDate} +1 day"));
}
  
// Prepare the SQL query
$query = "SELECT DATE_FORMAT(visit_date, '%Y-%m-%d') AS visit_date, COUNT(*) AS visit_num
          FROM patient_sub_visit
          WHERE visit_date BETWEEN ? AND ?
          GROUP BY visit_date";

$stmt = mysqli_prepare($conn, $query);

// Execute the query for each week
$weekData = array();

foreach ($startDates as $week => $startDate) {
    $endDate = $endDates[$week];
    mysqli_stmt_bind_param($stmt, 'ss', $startDate, $endDate);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Bind the result
    mysqli_stmt_bind_result($stmt, $visitDate, $numVisit);

    // Store the results in an associative array
    $visitData = array();
    $totalvisit = 0;

    while (mysqli_stmt_fetch($stmt)) {
        $visitData[$visitDate] = $numVisit;
        $totalvisit += $numVisit;
    }

    // Calculate the percentage for each day
    $percentageData = array();

    // Iterate over the dates within the week range
    $currentDate = $startDate;

    while ($currentDate <= $endDate) {
        $date = date("Y-m-d", strtotime($currentDate));
        $numVisit = isset($visitData[$date]) ? $visitData[$date] : 0;

        if($numVisit == 0){
            $percentage = 0;
        }else{
            $percentage = ($numVisit / $totalvisit) * 100;
        }
        $percentageData[$date] = round($percentage, 2);

        $currentDate = date("Y-m-d", strtotime("{$currentDate} +1 day"));
    }

    $weekData[$startDate] = array(
        'visitData' => $visitData,
        'percentageData' => $percentageData,
        'totalvisit' => $totalvisit,
        'endDate' => $endDate
    );
}

 
echo '
<div class="graph-plot swiper">
<div class="slide-container1">
<div class="swiper-wrapper">
';

// Output the results
foreach ($weekData as $startDate => $week) {
    $visitData = $week['visitData'];
    $percentageData = $week['percentageData'];
    $totalvisit = $week['totalvisit'];
    $endDate = $week['endDate'];

    echo '
        <div class="swiper-slide">
        <p>Week: <span><strong>' . $startDate . ' to ' . $endDate . '</strong></span></p>
        <div class="container">
        <div class="container-container">';
    
    foreach ($percentageData as $date => $percentage) {
        echo '
            <div class="chart-item">
            <div class="bar">
            <div class="bar-item" style="--barSize: ' . $percentage . '" title1="' . (isset($visitData[$date]) ? $visitData[$date] : 0) . '"></div>
            </div>
            <div class="bar-label">' . $date . '</div>
            </div>';
    }
    
    echo '
        </div>
        </div>   
        </div>';
}

echo '
</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
</div>
</div>
';
  
// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
