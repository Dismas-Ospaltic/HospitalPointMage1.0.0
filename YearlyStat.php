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
$query = "SELECT YEAR(visit_date) AS visit_year, MONTH(visit_date) AS visit_month, COUNT(*) AS visit_num
          FROM patient_sub_visit
          WHERE visit_date BETWEEN ? AND ?
          GROUP BY YEAR(visit_date), MONTH(visit_date)";

$stmt = mysqli_prepare($conn, $query);

// Execute the query for each month
$monthData = array();
$yearlySales = array();

foreach ($startDates as $year => $yearMonths) {
    $yearTotalVisit = 0;

    foreach ($yearMonths as $month => $startDate) {
        $endDate = $endDates[$year][$month];
        mysqli_stmt_bind_param($stmt, 'ss', $startDate, $endDate);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Bind the result
        mysqli_stmt_bind_result($stmt, $visitYear, $visitMonth, $numVisit);

        // Store the results in an associative array
        $visitData = array();
        $totalVisit = 0;

        while (mysqli_stmt_fetch($stmt)) {
            $visitData[$visitMonth] = $numVisit;
            $totalVisit += $numVisit;
            $yearTotalVisit += $numVisit;
        }
 
        $monthTotalVisit = ($totalVisit > 0) ? array_sum($visitData) : 0;
        $percentage = ($totalVisit > 0) ? ($monthTotalVisit / $totalVisit) * 100 : 0;

        $monthData[$year][$month] = array(
            'visitData' => $visitData,
            'percentage' => round($percentage, 2),
            'endDate' => $endDate
        );
    }

    $yearlyVisits[$year] = $yearTotalVisit;
}

echo '
<div class="graph-plot swiper">
<div class="slide-container2">
<div class="swiper-wrapper">
';

// Output the results
for ($y = date('Y', strtotime($earliestDate)); $y <= $currentYear; $y++) {
    echo '
    <div class="swiper-slide">
    <p>Year: <span><strong>' . $y . '</strong></span></p>';
    // Check if there is sales data available for the year
    if (isset($monthData[$y])) {
        $yearTotalVisit = $yearlyVisits[$y];

        echo '
        <p>Month: <span><strong>' . date("F", strtotime("$y-$month-01")) . '</strong></span></p>
        <div class="container">
        <div class="container-container">';

        for ($m = 1; $m <= 12; $m++) {
            $month = str_pad($m, 2, '0', STR_PAD_LEFT);

            if (isset($monthData[$y][$month])) {
                $visitData = $monthData[$y][$month]['visitData'];
                $percentage = $monthData[$y][$month]['percentage'];
                $endDate = $monthData[$y][$month]['endDate'];
            } else {
                $visitData = array();
                $percentage = 0;
                $endDate = date("Y-m-t", strtotime("$y-$month-01"));
            }

            $monthTotalVisit = array_sum($visitData);
            if ($yearTotalVisit > 0) {
                $percentage = ($monthTotalVisit / $yearTotalVisit) * 100;
            } else {
                $percentage = 0;
            }

            echo '<div class="chart-item">
                <div class="bar">
                <div class="bar-item" style="--barSize: ' . $percentage . '" title1="' . $monthTotalVisit . '"></div>
                </div>
                <div class="bar-label">' . date("F", strtotime("$y-$month-01")) . '</div>
            </div>';
        }

        echo '</div>
        </div>';
    } else {
        echo '<p>No sales data available for the year.</p>';
    }
   echo '</div>';
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
