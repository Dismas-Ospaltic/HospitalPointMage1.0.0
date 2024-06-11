<?php
@include 'config.php';

$select_Staff= mysqli_query($conn, "SELECT first_name,middle_name,last_name,role FROM employee_data ORDER BY role DESC");
if(mysqli_num_rows($select_Staff) > 0){
 
    while($row = mysqli_fetch_assoc($select_Staff)){
     echo '
             <label>
               <p id="single-staff">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</p>
               <p id="des">'.$row["role"].'</p>
              </label>
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