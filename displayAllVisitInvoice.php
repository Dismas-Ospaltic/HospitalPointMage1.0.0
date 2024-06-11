<?php
@include 'config.php';

  
   $select_single_gen =mysqli_query($conn, "SELECT * FROM invoice_list_gen WHERE total > 0 ORDER BY id DESC");

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
 <tr  onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/billing.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'&repoDate='.$row['invoice_date'].'\'); ChangeInvoiceMoreDet(); viewInvoiceDetails();">
 <td id="match-1">'.$row["invoice_num"].'</td>
 <td id="match-2">ksh. '.$row["total"].'</td>
 <td id="match-3">'.$row["invoice_date"].'</td>
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
    <section id="no-det-invo">
    <h3>No Data Available...</h3>
  </section>
    ';
  }



 ?>