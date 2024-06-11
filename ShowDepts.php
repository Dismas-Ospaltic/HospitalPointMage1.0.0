<?php
@include 'config.php';

$selcect_dept_data = mysqli_query($conn, "SELECT * FROM department_data");

echo '
<h3>all Departments</h3>
    
';
if(mysqli_num_rows($selcect_dept_data) > 0){
  while($row = mysqli_fetch_assoc($selcect_dept_data)){
    echo '
    <div class="dept-wrapper">
    <p>'.$row["dept_name"].'</p>
    <div class="right-btn">
     <button class="edit-btn"><i class="fa-solid fa-edit"></i>Edit</button>
     <button class="del-btn" onclick="if (confirm(\'Delete this Department?\')) { window.history.pushState({ id: \'100\' },\'Page 2\', \'/HMSMage/managereasource.php?dept_name='.$row["dept_name"].'&deptid='.$row["id"].'\'); Deletedept(); }"><i class="fa-solid fa-trash"></i>Delete</button>
    </div>

   </div>
    ';
  }

}else{
echo '
<section id="no-det">
<h3>No Data Available...</h3>
</section>
';
}



?>