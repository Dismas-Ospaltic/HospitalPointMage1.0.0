<?php
session_start();
@include 'config.php';



if(isset($_GET["name"]) && isset($_GET["proid"])){

  $name = mysqli_real_escape_string($conn, $_GET["name"]) ;
  $proid = mysqli_real_escape_string($conn, $_GET["proid"]) ;

  $select_single_det = mysqli_query($conn, "SELECT * FROM equipment_data WHERE product_name='{$name}' AND id='{$proid}'");
  if (mysqli_num_rows($select_single_det) > 0) {  
  $row = mysqli_fetch_assoc($select_single_det);

  echo '  
  <form action="#" method="post">
  <div class="input-wrapper">
                    <label>Product Name*</label>
                    <input type="text" name="text_name" placeholder="please enter name..." value="'. $row["product_name"].'">
                   </div>
          
                   <div class="input-wrapper">
                    <label>Product Code/ Serial No*</label>
                    <input type="text" name="text_code" placeholder="please enter serial No. ..." value="'. $row["serial_no"].'">
                   </div>
        
                   <div class="input-wrapper">
                    <label>Qty*</label>
                    <input type="number" name="text_qty" placeholder="please enter last name..." value="'. $row["qty"].'">
                   </div>
          
          
                   <div class="input-wrapper">
                    <label>Price</label>
                    <input type="number" name="text_price" placeholder="please enter buying Price..." value="'. $row["price"].'">
                   </div>
        
        
        
                   <div class="input-wrapper">
                    <label>Department</label>
                    <select name="text_dept">';

                    if(!empty($row["department"])){
                       echo ' <option value="'.$row["department"].'">'.$row["department"].'</option>';
                    }
                    $selcect_dept_data = mysqli_query($conn, "SELECT * FROM department_data");
                echo '<option value="">--Select Department--</option>';
                if(mysqli_num_rows($selcect_dept_data) > 0){
              while($row_in = mysqli_fetch_assoc($selcect_dept_data)){
             echo '<option value="'.$row_in["dept_name"].'">'.$row_in["dept_name"].'</option>';
              }
           }else{
            echo '<option value="">--Department Not Added--</option>';
            }

                  // echo '<option value="">--Select Department--</option>
                  // <option value="dental">dental</option>
                  // <option value="optical">optical</option>
                  // <option value="other">other</option>
                    echo '</select>
                   </div> 
          
                   <div class="input-wrapper">
                    <label>Description</label>
                    <textarea name="txt_description" placeholder="write a small description...">'.$row["description_pro"].'</textarea>
                   </div> 
        
                 
                   <div class="btn-wrapper">
                    <button class="emp-save" onclick="updateEquip()">Save</button>
                   </div>
          
</form>
  ';




  }
}else{
    echo "not set";
}

?>