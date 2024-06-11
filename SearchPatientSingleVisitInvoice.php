<?php
@include 'config.php';

if(isset($_GET["repoDate"])){
 $date = mysqli_real_escape_string($conn, $_GET["repoDate"]);

 $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
 $output = "";


 $select_totals_invoice = mysqli_query($conn, "SELECT SUM(total) AS Total_ch FROM invoice_list_gen WHERE invoice_date ='{$date}' ");
 if (mysqli_num_rows($select_totals_invoice) > 0) { 
 $row_in = mysqli_fetch_assoc($select_totals_invoice);
  $total_cash = $row_in['Total_ch'] + 0;
   }else{
      $total_cash = 0; 
   }


   echo '
   <div class="num-dis">
   <label class="total-cont"><span>Total: </span><strong>ksh.'.$total_cash.'</strong></label>
   <label class="date-cont"><span>Date:</span><strong>'.$date.'</strong></label>
   </div>
   ';

   $select_single_gen = mysqli_query($conn, "SELECT * FROM invoice_list_gen WHERE (invoice_num LIKE '%{$searchTerm}%' OR visit_id LIKE '%{$searchTerm}%' OR print_by LIKE '%{$searchTerm}%' 
   OR hospital_patient_no LIKE '%{$searchTerm}%') AND (invoice_date ='{$date}') ORDER BY id DESC");

   echo '
   <section id="outer-table">
   <div class="table-container">
   ';
  if(mysqli_num_rows($select_single_gen) > 0){
echo '
<table>
<thead>
    <tr>
        <th id="head-1">Invoice No.</th>
        <th id="head-2">Total</th>
        <th id="head-3">Time</th>
        <th id="head-4">Hospital Reg.</th>
        <th id="head-5">Visit id</th>
        <th id="head-6">Added by</th>
    </tr>
</thead>
<tbody>
';


while($row = mysqli_fetch_assoc($select_single_gen)){
 echo '
 <tr  onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/patientInvoices.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'&repoDate='.$row['invoice_date'].'\'); ChangeInvoiceMoreDetDisplay(); ShowInvoCont();">
 <td id="match-1">'.$row["invoice_num"].'</td>
 <td id="match-2">ksh. '.$row["total"].'</td>
 <td id="match-3">'.$row["invoice_time"].'</td>
 <td id="match-4">'.$row["hospital_patient_no"].'</td>
 <td id="match-5">'.$row["visit_id"].'</td>
 <td id="match-6">'.$row["print_by"].'</td>
</tr>
 ';
}

echo '
</tbody>
<tfoot>

</tfoot>
</table>';
  }else{
    echo '
    <section id="no-det">
    <h3>No Data Available...</h3>
  </section>
    ';
  }
  echo '
  </div>
  </section>
  ';



}else{
    echo "not Set";
}
 ?>