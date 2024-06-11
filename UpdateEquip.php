<?php
@include 'config.php';

if(isset($_GET["name"]) && isset($_GET["proid"])){
  
    $name= mysqli_real_escape_string($conn, $_GET["name"]);
    $proid= mysqli_real_escape_string($conn, $_GET["proid"]);

    $text_name= $_POST["text_name"];
    $text_code= $_POST["text_code"];
    $text_qty= $_POST["text_qty"];
    $text_price=$_POST["text_price"];
    $text_dept=$_POST["text_dept"];
    $txt_description=$_POST["txt_description"];
    
      
    $san_text_name=mysqli_real_escape_string($conn, $text_name);
    $san_text_code=mysqli_real_escape_string($conn, $text_code);
     $san_text_qty=mysqli_real_escape_string($conn, $text_qty);
     $san_text_price=mysqli_real_escape_string($conn, $text_price);
     $san_text_dept=mysqli_real_escape_string($conn, $text_dept);
     $san_txt_description=mysqli_real_escape_string($conn, $txt_description);
    
    
     $ifExists = false;
    $select_row_unique = mysqli_query($conn, "SELECT * FROM equipment_data WHERE product_name = '{$text_name}'");
    if (mysqli_num_rows($select_row_unique) > 0) { 
        $row_Exist = mysqli_fetch_assoc($select_row_unique) ;
        if($row_Exist["product_name"] ==$name){
            $ifExists = false; 
        }else{
            $ifExists = true;
        }
        
    }else{
        $ifExists = false;
    }
    
    
    if(!empty($san_text_qty) && !empty($san_text_code) && !empty($san_text_name)){
    
        if(!$ifExists){
           $update_new_Equip = mysqli_query($conn, "UPDATE equipment_data SET product_name='{$san_text_name}',serial_no='{$san_text_code}',qty='{$san_text_qty}',price='{$san_text_price}',department='{$san_text_dept}',description_pro='{$san_txt_description}'");
           
           if($update_new_Equip){
           echo "added successfully";
           }else{
           echo "failed";
           }
       }else{
           echo "equip exists";
       }
       
       
       }else{
           echo "empty fields";
       }
    
}else{
    echo "not set";
}

?>