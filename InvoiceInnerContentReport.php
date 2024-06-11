<?php
@include 'config.php';

$patientDet =false;
$InvGenDet =false;
$InvListDet =false;
if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){
    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $V_ID = mysqli_real_escape_string($conn, $_GET["V_ID"]);

    //select patient det 
    $select_Patient = mysqli_query($conn, "SELECT first_name,middle_name,last_name,age,gender,hospital_patient_no,odp_idp_no,phone,residence,insurance_comp,insurance_no FROM patient_details WHERE hospital_patient_no = '{$hospital_unique}'");

    if(mysqli_num_rows($select_Patient) > 0){
       $row_pat = mysqli_fetch_assoc($select_Patient);

       $patient_name = $row_pat["first_name"].' '.$row_pat["middle_name"].' '.$row_pat["last_name"];
       $patient_no = $row_pat["hospital_patient_no"];
       $department_no =$row_pat["odp_idp_no"];
       $patient_contact =$row_pat["phone"];
       $patient_residence = $row_pat["residence"];
       $patient_insurance = $row_pat["insurance_comp"];
       $patient_member =$row_pat["insurance_no"];
       $patient_age =$row_pat["age"];
       $patient_gender = $row_pat["gender"];
        $patientDet =true;
    }else{
        $patientDet =false;
        // echo "none";
    }



        //select invoice det 
        $select_invoice_gen = mysqli_query($conn, "SELECT invoice_num,total,print_by,invoice_date,invoice_time FROM invoice_list_gen WHERE hospital_patient_no = '{$hospital_unique}' AND visit_id='{$V_ID}' AND status='pending'");

        if(mysqli_num_rows($select_invoice_gen) > 0){
           $row_invGen = mysqli_fetch_assoc($select_invoice_gen);
    
           $invoice_no =$row_invGen["invoice_num"];
           $invoice_grand_total =$row_invGen["total"];
           $invoice_user_add =$row_invGen["print_by"];
           $invoice_date =$row_invGen["invoice_date"];
           $invoice_time =$row_invGen["invoice_time"];
   
            $InvGenDet =true;
        }else{
            $InvGenDet =false;
            // echo "none";
        }


                //select invoice  list det 
                $select_invoice_list = mysqli_query($conn, "SELECT product_service,qty,price,sub_ttl FROM invoice_list WHERE (invoice_num = '{$invoice_no}' OR visit_id='{$V_ID}') AND status='pending'");

                if(mysqli_num_rows($select_invoice_list) > 0){
              $InvListDet =true;
                }else{
                    $InvListDet =false;
                    // echo "none";
                }

$select_facility = mysqli_query($conn, "SELECT * FROM facility_data LIMIT 1");
        
if($patientDet && $InvGenDet && $InvListDet){

echo '
 <div class="invo-head-det">
<div class="left-sec-head">';

if(mysqli_num_rows($select_facility) > 0){
    $row_facility = mysqli_fetch_assoc($select_facility);
echo '
<h1>'.$row_facility["name"].'</h1>
<label><h4>Address:</h4><span>'.$row_facility["address"].'</span></label>
<label><h4>Email:</h4><span>'.$row_facility["email"].'</span></label>
<label><h4>Contact:</h4><span>'.$row_facility["contact"].'</span></label>
';

}else{
echo '
<h1>Facility Nmae</h1>
<label><h4>Address:</h4><span>PO BOX _ _ _</span></label>
<label><h4>Email:</h4><span>_ _ _</span></label>
<label><h4>Contact:</h4><span>_ _ _</span></label>
';
}



echo '</div>
<div class="right-sec-head" >
    <i class="fa-solid fa-stethoscope"></i>
    <h1>Hospital Invoice</h1>
</div>  
   </div>

   <div class="invo-pat-intro-det">
    <div class="left-sec-intro">
    
    <label><h1>Patient: '.$patient_name.'</h1><span></span></label>
    <label><h4>'.$patient_age.' year old '.$patient_gender.'</h4></label>
    <label><h4>Patient Reg No:</h4><span>'.$patient_no.'</span></label>
    <label><h4>ODP NO/ IDP No:</h4><span>'.$department_no.'</span></label>
    <label><h4>Contact:</h4><span>'.$patient_contact.'</span></label>';

    if(!empty($patient_residence)){
   echo ' <label><h4>Residence:</h4><span>'.$patient_residence.'</span></label>';
    }
    if(!empty($patient_insurance)){
        echo '<label><h4>Insurance Company:</h4><span>'.$patient_insurance.'</span></label>';
    }
    if(!empty($patient_member)){
        echo '<label><h4>Insurance Member No:</h4><span>'.$patient_member.'</span></label>';
    }
    
        $select_dischargeDate = mysqli_query($conn, "SELECT discharge_date FROM patient_sub_visit WHERE hospital_patient_no = '{$hospital_unique}' AND visit_id='{$V_ID}'");
         if(mysqli_num_rows($select_dischargeDate) > 0){
        $rowdischarge = mysqli_fetch_assoc($select_dischargeDate);
        if(!empty($rowdischarge["discharge_date"])){
            echo '<label><h4>Discharge Date:</h4><span>'.$rowdischarge["discharge_date"].'</span></label>';
         }
         }else{

         }
        
   
    echo '</div>
    <div class="right-sec-intro" >
        <label><h1>Invoice No: </h1><span>'.$invoice_no.'</span></label>
        <label><h1>Invoice Date:</h1><span>'.$invoice_date.' at '.$invoice_time.'</span></label>
    </div>  
       </div>

       <div class="invo-table-container">

        <table>
            <thead>
                <tr>
                    <th id="head-1-in"><h1>Service/ product Description</h1></th>
                    <th id="head-2-in"><h1>Price</h1></th>
                    <th id="head-3-in"><h1>qty</h1></th>
                    <th id="head-4-in"><h1>Total</h1></th>
                </tr>
            </thead>
            <tbody>';
            while($row_invList = mysqli_fetch_assoc($select_invoice_list)){  
            
                $service = $row_invList["product_service"];
                $quantity = $row_invList["qty"];
                $price = $row_invList["price"];
                 $Sub_total =$row_invList["sub_ttl"];

                 echo '<tr>
                 <td id="match-1-in">'.$service.'</td>
                 <td id="match-2-in">'.$price.'</td>
                 <td id="match-3-in">'.$quantity.'</td>
                 <td id="match-4-in">'.$Sub_total.'</td>
                  </tr>';


            }
           echo '</tbody>
            <tfoot>
                <tr>
                    <td id="match-1-inf" colspan="3"><h1>Total</h1></td>
                    <td id="match-2-inf"><h1>'.$invoice_grand_total.'</h1></td>
                </tr>
            </tfoot>
        </table>
        
       </div>
     <div id="stamp">
        <h1>Doctor\'s Signature?stamp ____________________________________________</h1>
     </div>
     <div id="man-water-mark">
        <label><small>This system was designed by </small><span>Ospaltic Software Solutions</span></label>
        <label><small><i class="fa-solid fa-phone"></i>Contact: </small><span>+254742354784, +254736218327</span></label>
        <label><small><i class="fa-solid fa-envelope"></i>Email: </small><span>ospaltic@gmail.com</span></label>
        <label><small><i class="fa-solid fa-f"></i>facebook: </small><span>Ospaltic</span></label>
     </div>
';



}else{
    echo "not complete";
}


}else{
    echo "not set";
}




   

?>