<?php
@include 'config.php';

$select_Hist = mysqli_query($conn, "SELECT * FROM laboratory_test WHERE status='tested' ORDER BY id DESC");
echo '<table>
     <thead>
     <tr>
     <th id="head-1">Patient</th>
     <th id="head-2">HSPT Reg.</th>
      <th id="head-3">Visit id</th>
      <th id="head-4">Sample No.</th>
      <th id="head-5">Date</th>
      <th id="head-6">Added By</th>
      </tr>
      </thead>
    <tbody>';
if(mysqli_num_rows($select_Hist) > 0){
 
while($row = mysqli_fetch_assoc($select_Hist)){
echo '
<tr  onclick="window.history.pushState({ id: \'100\' }, \'Page 2\', \'/HMSMage/laboratory.php?HSPN='.$row['hospital_patient_no'].'&V_ID='.$row['visit_id'].'\'); displayLabDetCardForComlete(); displayLabDetCardForComp();">
<td id="match-1">'.$row["patient_name"].'</td>
<td id="match-2">'.$row["hospital_patient_no"].'</td>
<td id="match-3">'.$row["visit_id"].'</td>
<td id="match-4">'.$row["sample_no"].'</td>
<td id="match-5">'.$row["return_date"].'</td>
<td id="match-6">'.$row["lab_tech"].'</td>
</tr>
';
}
}else{
echo '
<section id="no-det">
<h3>No Data Available...</h3>
</section>
';
}

echo '
</tbody>
<tfoot>

</tfoot>
</table>
';
?>