<?php
@include 'config.php';


$select_visit_report = mysqli_query($conn, "SELECT visit_date FROM patient_sub_visit GROUP BY visit_date ORDER BY id DESC");
 if (mysqli_num_rows($select_visit_report) > 0) { 

    while ($row = mysqli_fetch_assoc($select_visit_report)) {
        $date = $row['visit_date'];
  

        $select_count_visit= mysqli_query($conn, "SELECT COUNT(*) FROM patient_sub_visit WHERE visit_date='{$date}'");
        $number_visit_row = mysqli_fetch_array($select_count_visit);
        $total_no_visit= $number_visit_row[0];
      
        $select_count_invoice= mysqli_query($conn, "SELECT COUNT(*) FROM invoice_list_gen WHERE invoice_date='{$date}'");
        $number_invo_row = mysqli_fetch_array($select_count_invoice);
        $total_no_invo= $number_invo_row[0];



      $select_totals_invoice = mysqli_query($conn, "SELECT SUM(total) AS Total_ch FROM invoice_list_gen WHERE invoice_date ='{$date}' ");
       if (mysqli_num_rows($select_totals_invoice) > 0) { 
       $row_in = mysqli_fetch_assoc($select_totals_invoice);
        $total_cash = $row_in['Total_ch'] + 0;
         }else{
            $total_cash = 0; 
         }


        echo '
        <div class="repo-single">
        <div class="date-cont">
          <label><i class="fa-solid fa-calendar-alt"></i><strong>Date: </strong></label>
          <p>'.$date.'</p>
        </div>
        <div class="bottom-cont-det">
          <div class="left-cont-det">
           <div class="top-left">
            <label><strong>'.$total_no_visit.'</strong><p>Visits</p></label>
            <label><strong>'.$total_no_invo.'</strong><p>Invoices</p></label>
           </div>
           <div class="bottom-left">
              <label><strong>ksh '.$total_cash.'</strong><p>Total Bills</p></label>
              <label><strong>ksh '.$total_cash.'</strong><p>Paid</p></label>
           </div>
          </div>
           <div class="right-cont-opp">
            <a href="patientVisit.php?repoDate='.$date.'"><span>view Visits</span><i class="fa-solid fa-arrow-circle-right"></i></a>
            <a href="patientInvoices.php?repoDate='.$date.'"><span>view Invoices</span><i class="fa-solid fa-arrow-circle-right"></i></a>
           </div>
        </div>
       </div>
        ';


    }
 }else{

echo '
<section id="no-det">
<h3>No Data Available...</h3>
</section>;
';
 }
?>