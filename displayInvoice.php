<?php
@include 'config.php';
if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
   $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
   $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);


$VisitIDisset =false;

$select_visit_id = mysqli_query($conn, "SELECT visit_id FROM patient_sub_visit WHERE (hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND status='not_tend' LIMIT 1");
if(mysqli_num_rows($select_visit_id) > 0){
    $VisitIDisset =true;
    $row_inner = mysqli_fetch_assoc($select_visit_id);
    $visit_id = $row_inner["visit_id"];
}

if($VisitIDisset){
    $select_invoice_list =mysqli_query($conn, "SELECT * FROM invoice_list WHERE hospital_patient_no = '{$hospital_unique}' AND visit_id='{$visit_id}' AND status='pending'");
echo'
<div class="invoice-exist">
<h4>Previously Added Bills for current Visit</h4>';
  if(mysqli_num_rows($select_invoice_list) > 0){
    echo '
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th id="head-1-s">Service/ product</th>
                    <th id="head-2-s">qty</th>
                    <th id="head-3-s">total</th>
                    <th id="head-4-s">Actions</th>
                </tr>
            </thead>
            <tbody>
    '; 
 
    while ($row = mysqli_fetch_assoc($select_invoice_list)) {
      $invoice_num = $row["invoice_num"];
      $PN = $row['hospital_patient_no'];
      $VID = $row['visit_id'];
      $PRODUCT = $row["product_service"];
       $id=$row["id"];
      echo '<tr>
          <td class="match-1-s">' . $row["product_service"] . '</td>
          <td class="match-2-s"><p>' . $row["qty"] . '</p></td>
          <td class="match-3-s">' . $row["sub_ttl"] . '</td>
          <td class="match-4-s">
              <i class="fa-solid fa-times-circle delete" onclick="if(confirm(\'Are you sure you want to delete? Action cannot be undone\')){window.history.pushState({id:\'100\'},\'Page 2\',\'/HMSMage/billing.php?product_name='.urlencode($PRODUCT).'&V_ID='.urlencode($VID).'&INVO_NUM='.urlencode($invoice_num).'&HSPN='.urlencode($PN).'&num_det='.urlencode($id).'\'); DeleteListInvoice(); ChangeInvoice();}"></i>
              <i class="fa-solid fa-edit edit" onclick="window.history.pushState({id:\'100\'},\'Page 2\',\'/HMSMage/billing.php?product_name='.urlencode($PRODUCT).'&V_ID='.urlencode($VID).'&INVO_NUM='.urlencode($invoice_num).'&HSPN='.urlencode($PN).'&num_det='.urlencode($id).'\'); ChangeInvoiceToEdit(); showEditServiceCont();"></i>
          </td>
      </tr>';
  }

   echo '</tbody>
    <tfoot>

    </tfoot>
</table>


<div class="print-btn">
<button id="view-inv" onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/billing.php?HSPN='.$PN.'&V_ID='.$VID.'\'); ChangeInvoiceMoreDet(); viewInvoiceDetails();">View invoce</button>
<button>View PDF invoice</button>
<button onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/billing.php?HSPN='.$PN.'&V_ID='.$VID.'\'); ChangeInvoiceMoreDet(); viewInvoiceDetails(); printInvoice();">Print Invoice</button>
</div>';
  }else{
    $invoice_num = "";
    echo '
    <section id="no-det">
    <h3>No Data Available...</h3>
  </section>
    ';

  }
  echo '
  </div>
  ';
 echo '</div>';


 
  echo '
  <div class="inv-pat-det">
  <div class="inv-det">
    <h4>invoice details</h4>';
   if(!empty($invoice_num)){
    $select_invoice_list_gen =mysqli_query($conn, "SELECT * FROM invoice_list_gen WHERE invoice_num = '{$invoice_num}' AND visit_id='{$visit_id}' LIMIT 1");
    if(mysqli_num_rows($select_invoice_list_gen) > 0){
        $row_gen = mysqli_fetch_assoc($select_invoice_list_gen);
        echo'
        <p><strong>invoice No. :</strong><span>'.$row_gen["invoice_num"].'</span></p>
        <p><strong>invoice Date :</strong><span>'.$row_gen["invoice_date"].'</span></p>';
    }else{
        echo '
        <section id="no-det">
        <h3>No Data Available...</h3>
      </section>
        '; 
    }

    }else{
    echo '<p><strong>invoice No. :</strong><span>---</span></p>
    <p><strong>invoice Date :</strong><span>---</span></p>';
    }
 



  echo '</div>
  <div class="pat-det">
      <h4>Patient details</h4>';
      $select_Patient_det =mysqli_query($conn, "SELECT first_name,middle_name,last_name,hospital_patient_no,odp_idp_no FROM patient_details WHERE hospital_patient_no = '{$hospital_unique}' OR odp_idp_no='{$DP_NO}'");
      if(mysqli_num_rows($select_Patient_det) > 0){
        $row_pat = mysqli_fetch_assoc($select_Patient_det);

      echo '<p><strong>Name :</strong><span>'.$row_pat["first_name"].' '.$row_pat["middle_name"].' '.$row_pat["last_name"].'</span></p>
      <p><strong>ODP /IDP No. :</strong><span>'.$row_pat["odp_idp_no"].'</span></p>
      <p><strong>Hospital Reg No. :</strong><span>'.$row_pat["hospital_patient_no"].'</span></p>';
      }else{
    echo '
    <p><strong>Name :</strong><span>---</span></p>
    <p><strong>ODP /IDP No. :</strong><span>---</span></p>
    <p><strong>Hospital Reg No. :</strong><span>---</span></p>
    ';
      }
 echo '
  </div>
</div>
  ';


}else{
    echo "no visit ID";
}

}else{
    echo "not set";
}
?>