<?php
@include 'config.php';
   
if(isset($_GET["HSPN"]) || isset($_GET["ODPIDP"])){

    if(isset($_GET["HSPN"])){
        $Hospt_reg = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    }else{
        $Hospt_reg = "none";
    }


    if(isset($_GET["ODPIDP"])){
        $Dept_no= mysqli_real_escape_string($conn, $_GET["ODPIDP"]);
    }else{
        $Dept_no= "none";
    }



 $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
 $output = "";
 
 $select_patient_data_visits = mysqli_query($conn, "SELECT * FROM patient_sub_visit WHERE (visit LIKE '%{$searchTerm}%' OR visit_date LIKE '%{$searchTerm}%' OR tend_by LIKE '%{$searchTerm}%' 
 OR department LIKE '%{$searchTerm}%' OR visit_reason LIKE '%{$searchTerm}%') AND (hospital_patient_no ='{$Hospt_reg}' OR odp_idp_no ='{$Dept_no}')");
 echo'
 <div class="main-container-table">
 <div id="head-det">
 <div class="head-1">
 <p><strong>Visit</strong></p>
 </div>
 <div class="head-2">
 <p><strong>Reason</strong></p>
 </div>
 <div class="head-3">
 <p><strong>Department</strong></p>
 </div>
 <div class="head-4">
 <p><strong>Visit Date</strong></p>
 </div>
 <div class="head-5">
 <p><strong>Discharge Date</strong></p>
 </div>
 <div class="head-6">
 <p><strong>Doctor</strong></p>
 </div>
 
 </div>
 ';
 if(mysqli_num_rows($select_patient_data_visits) > 0){
 
 
     while($row = mysqli_fetch_assoc($select_patient_data_visits)){
         echo '
         <div class="body-det">
         <div class="bdy match-1">
             <p>'.$row["visit"].'</p>
            </div>
            <div class="bdy match-2">
             <p>'.$row["visit_reason"].'</p>
            </div>
            <div class="bdy match-3">
             <p>'.$row["department"].'</p>
            </div>
            <div class="bdy match-4">
             <p>'.$row["visit_date"].'</p>
            </div>
            <div class="bdy match-5">
             <p>'.$row["discharge_date"].'</p>
            </div>
            <div class="bdy match-6">
             <p>'.$row["tend_by"].'</p>
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
 echo '
 </div>
 ';

}else{
    echo '
    <section id="no-det">
<h3>No Data Available...</h3>
</section>
    ';  
}

   
?> 