<?php
@include 'config.php';

if(isset($_GET["repoDate"])){
 $date = mysqli_real_escape_string($conn, $_GET["repoDate"]);

 $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
$output = "";

 $select_count_visit= mysqli_query($conn, "SELECT COUNT(*) FROM patient_sub_visit WHERE visit_date='{$date}'");
 $number_visit_row = mysqli_fetch_array($select_count_visit);
 $total_no_visit= $number_visit_row[0];



 echo '
 <div class="num-dis">
 <label class="total-cont"><span>Total Patients Visits: </span><strong>'.$total_no_visit.'</strong></label>
 <label class="date-cont"><span>Date:</span><strong>'.$date.'</strong></label>
</div>
 ';

$select_single_visit = mysqli_query($conn, "SELECT pateint_name,hospital_patient_no,visit,visit_time,sent_by,tend_by,discharge_date FROM patient_sub_visit WHERE (visit LIKE '%{$searchTerm}%' OR discharge_date LIKE '%{$searchTerm}%' OR tend_by LIKE '%{$searchTerm}%' 
OR department LIKE '%{$searchTerm}%' OR visit_reason LIKE '%{$searchTerm}%' OR visit_id LIKE '%{$searchTerm}%' OR pateint_name LIKE '%{$searchTerm}%' OR hospital_patient_no LIKE '%{$searchTerm}%') AND (visit_date ='{$date}') ORDER BY id DESC");
echo '
<section id="outer-table">
<div class="table-container">
';
 if(mysqli_num_rows($select_single_visit) > 0 ){
  echo '
  <table>
  <thead>
      <tr>
          <th id="head-1">patient</th>
          <th id="head-2">Reg No.</th>
          <th id="head-3">Visit</th>
          <th id="head-4">Time</th>
          <th id="head-5">Visit Added By</th>
          <th id="head-6">Tend By</th>
          <th id="head-7">Discharge Date</th>
      </tr>
  </thead>
  <tbody>
  ';

   while($row = mysqli_fetch_assoc($select_single_visit)){

 echo '
 <tr>
 <td id="match-1">'.$row["pateint_name"].'</td>
 <td id="match-2">'.$row["hospital_patient_no"].'</td>
 <td id="match-3">'.$row["visit"].'</td>
 <td id="match-4">'.$row["visit_time"].'</td>
 <td id="match-5">'.$row["sent_by"].'</td>
 <td id="match-6">'.$row["tend_by"].'</td>
 <td id="match-7">'.$row["discharge_date"].'</td>
</tr>
 ';

   }

echo '
</tbody>
<tfoot>

</tfoot>
</table>
';


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