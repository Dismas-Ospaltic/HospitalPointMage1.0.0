<?php
@include 'config.php';

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){
    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);
    // 
$select_patient_det = mysqli_query($conn, "SELECT first_name,middle_name,last_name,age,gender,p_blood_type,p_weight,height FROM patient_details WHERE hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}' LIMIT 1");

if(mysqli_num_rows($select_patient_det) > 0){

    $row = mysqli_fetch_assoc($select_patient_det);

    echo '
    <form action="#" method="post">
                        <div class="input-wrapper">
                            <label>First Name *</label>
                           <input type="text" name="text_fname" placeholder="Please enter first Name" value="'.$row["first_name"].'">
                           </div>    

                           <div class="input-wrapper">
                            <label>Middle Name</label>
                           <input type="text" name="text_mname" placeholder="Please enter middle Name" value="'.$row["middle_name"].'">
                           </div>


                           <div class="input-wrapper">
                            <label>Last Name *</label>
                           <input type="text" name="text_lname" placeholder="Please enter last Name" value="'.$row["last_name"].'">
                           </div>


                        <div class="input-wrapper">
                            <label>Age *</label>
                           <input type="text" name="text_age" placeholder="Please enter Age" value="'.$row["age"].'">
                        </div>


                        <div class="input-wrapper">
                            <label>Gender *</label>
                            <select name="text_gender">
                            <option value="'.$row["gender"].'">'.$row["gender"].'</option>
                              <option value="">--Select Gender--</option>
                              <option value="Male">Male</option>
                               <option value="Female">Female</option>
                               <option value="Other">Other</option>
                            </select>
                           </div>


                       <div class="input-wrapper">
                        <label>Blood Group </label>';

                       echo '
                        <select name="text_blood">';

                      if(!empty($row["p_blood_type"])){
                            echo ' <option value="'.$row["p_blood_type"].'">'.$row["p_blood_type"].'</option>';
                         }
                        echo '<option value="">--Select Blood Group--</option>
                          <option value="A+">A+</option>
                           <option value="A-">A-</option>
                           <option value="B+">B+</option>
                           <option value="B-">B-</option>
                           <option value="AB+">AB+</option>
                           <option value="AB-">AB-</option>
                           <option value="O+">O+</option>
                           <option value="O-">O-</option>
                           <option value="Other">Other</option>
                        </select>

                       </div> 
                
                       <div class="input-wrapper">
                        <label>Height</label>
                       <input type="text" name="text_height" placeholder="Please enter Height" value="'.$row["height"].'">
                       </div>
              
                       <div class="input-wrapper">
                        <label>Weight</label>
                       <input type="text" name="text_weight" placeholder="please enter patient\'s Weight" value="'.$row["p_weight"].'">
                       </div>
                
                     
                       <div class="btn-wrapper">
                        <button class="save-btn" onclick="UpdatePatientDetsDoc()"><i class="fa-solid fa-plus"></i>Save Changes</button>
                       </div>
                      </form>
    ';
}

}else{
    echo "not set";
}
?>