<?php
@include 'config.php';

$select_staff = mysqli_query($conn, "SELECT * FROM employee_data");

if(mysqli_num_rows($select_staff) > 0){
    echo '
    <table>
    <thead>
        <tr>
        <th id="head-1">Name</th>
        <th id="head-2">Gender</th>
        <th id="head-3">National ID</th>
        <th id="head-4">email</th>
        <th id="head-5">Phone Contact</th>
        <th id="head-6">Role</th>
        <th id="head-7">PassWord</th>
        <th id="head-8">Added On</th>
        <th id="head-9">Action</th>
        </tr>
        </thead> 
    <tbody>
    ';
   while($row = mysqli_fetch_assoc($select_staff)){

echo '
<tr>
<td class="match-1">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</td>
<td class="match-2">'.$row["gender"].'</td>
<td class="match-3">'.$row["national_id"].'</td>
<td class="match-4">'.$row["email_address"].'</td>
<td class="match-5">'.$row["contact"].'</td>
<td class="match-6">'.$row["role"].'</td>
<td class="match-7">'.$row["pass_key"].'</td>
<td class="match-8">'.$row["add_date"].'</td>
<td class="match-9">
  <button class="edit-btn" onclick="window.history.pushState({ id: \'100\' },\'Page 2\', \'/HMSMage/managereasource.php?mail='.$row["email_address"].'\'); changeempDet(); showEmpDetCont(); ">Edit</button>
  <button class="del-btn" onclick="if (confirm(\'Delete this employee?\')) { window.history.pushState({ id: \'100\' },\'Page 2\', \'/HMSMage/managereasource.php?mail='.$row["email_address"].'\'); DeleteempDet(); }">Delete</button>
</td>
</tr>
';

   }

 echo '</tbody>
   <tfoot>
   </tfoot>
</table>';


}else{
echo '<section id="no-det">
<h3>No Data Available...</h3>
</section>';
}


?>