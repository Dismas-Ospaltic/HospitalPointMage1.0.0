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

// Calculate the start and end dates for each month
$startDates = array();
$endDates = array();
$date = new DateTime($earliestDate);

while ($date <= new DateTime($currentDate)) {
    $year = $date->format('Y');
    $month = $date->format('m');
    $startDate = $date->format('Y-m-01');
    $endDate = $date->format('Y-m-t');

    // Store the start and end dates for each month
    $startDates[$year][$month] = $startDate;
    $endDates[$year][$month] = $endDate;

    $date->modify('+1 month');
}

// Prepare the SQL query
$query = "SELECT DATE_FORMAT(visit_date, '%Y-%m-%d') AS visit_date, COUNT(*) AS visit_num
          FROM patient_sub_visit
          WHERE visit_date BETWEEN ? AND ?
          GROUP BY visit_date";

$stmt = mysqli_prepare($conn, $query);

// Execute the query for each month
$monthData = array();

foreach ($startDates as $year => $yearMonths) {
    foreach ($yearMonths as $month => $startDate) {
        $endDate = $endDates[$year][$month];
        mysqli_stmt_bind_param($stmt, 'ss', $startDate, $endDate);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Bind the result
        mysqli_stmt_bind_result($stmt, $visitDate, $numVisit);

        // Store the results in an associative array
        $VisitData = array();
        $totalvisit = 0;

        while (mysqli_stmt_fetch($stmt)) {
            $VisitData [$visitDate] = $numVisit;
            $totalvisit += $numVisit;
        }

        // Calculate the percentage for each day
        $percentageData = array();

        $date = new DateTime($startDate);

        while ($date <= new DateTime($endDate)) {
            $formattedDate = $date->format('Y-m-d');
            $numVisit = isset($VisitData[$formattedDate]) ? $VisitData[$formattedDate] : 0;
        if($numVisit == 0){
            $percentage = 0;
        }else{
            $percentage = ($numVisit / $totalvisit) * 100;
        }
          

            $percentageData[$formattedDate] = round($percentage, 2);
            $date->modify('+1 day');
        }

        $monthData[$year][$month] = array(
            'VisitData' => $VisitData,
            'percentageData' => $percentageData,
            'totalvisit' => $totalvisit,
            'endDate' => $endDate
        );
    }
}

// Output the results
echo '
<div class="graph-plot swiper">
<div class="slide-container">
<div class="swiper-wrapper">
';

foreach ($monthData as $year => $yearMonths) {
    foreach ($yearMonths as $month => $monthData) {
        $VisitData = $monthData['VisitData'];
        $percentageData = $monthData['percentageData'];
        $totalvisit = $monthData['totalvisit'];
        $endDate = $monthData['endDate'];

        echo '
        <div class="swiper-slide">
        <p>Month: <span><strong>'.$month."-".$year.' to '.$endDate.'</strong></span></p>
        <div class="container">
        <div class="container-container">
        ';

        $date = new DateTime($startDates[$year][$month]);

        while ($date <= new DateTime($endDate)) {
            $formattedDate = $date->format('Y-m-d');
            $percentage = isset($percentageData[$formattedDate]) ? $percentageData[$formattedDate] : 0;
          
            $visit = isset($VisitData[$formattedDate]) ? $VisitData[$formattedDate] : 0;

            echo '
            <div class="chart-item">
                <div class="bar">
                    <div class="bar-item" style="--barSize: '.$percentage.'" title1="'.$visit.'"></div>
                </div>
                <div class="bar-label">'.date('d', strtotime($formattedDate)).'</div> 
            </div>
            ';

            $date->modify('+1 day');
        }

        echo '
        </div>
        </div>
        </div>
        ';
    }
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
