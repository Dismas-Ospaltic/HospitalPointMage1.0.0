<?php
@include 'config.php';

$select_equip = mysqli_query($conn, "SELECT * FROM equipment_data");

if(mysqli_num_rows($select_equip) > 0){
    echo '
    <table>
    <thead>
        <tr>
        <th id="head-11">Name</th>
        <th id="head-22">Serial No</th>
        <th id="head-33">Qty</th>
        <th id="head-44">Price</th>
        <th id="head-55">Department</th>
        <th id="head-66">Description</th>
        <th id="head-77">Actions</th>
        </tr>
        </thead> 
    <tbody>
    ';
   while($row = mysqli_fetch_assoc($select_equip)){

echo '
<tr>
<td class="match-11">'.$row["product_name"].'</td>
<td class="match-22">'.$row["serial_no"].'</td>
<td class="match-33">'.$row["qty"].'</td>
<td class="match-44">'.$row["price"].'</td>
<td class="match-55">'.$row["department"].'</td>
<td class="match-66">'.$row["description_pro"].'</td>
<td class="match-77">
  <button class="edit-btn1" onclick="window.history.pushState({ id: \'100\' },\'Page 2\', \'/HMSMage/managereasource.php?name='.$row["product_name"].'&proid='.$row["id"].'\'); changeequipDet(); showEquipDetCont(); ">Edit</button>
  <button class="del-btn1" onclick="if (confirm(\'Delete this employee?\')) { window.history.pushState({ id: \'100\' },\'Page 2\', \'/HMSMage/managereasource.php?name='.$row["product_name"].'&proid='.$row["id"].'\'); DeleteequipDet(); }">Delete</button>
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