<?php
@include 'config.php';
$current_date = date("Y-m-d");


    $select_facility_det = mysqli_query($conn, "SELECT * FROM facility_data LIMIT 1");
    if(mysqli_num_rows($select_facility_det) > 0){
     echo "Profile added"; 
    }else{
 
        $text_name = $_POST["text_name"];
        $text_mail = $_POST["text_mail"];
        $text_contact = $_POST["text_contact"];
        $text_address = $_POST["text_address"];
        
        
        $san_text_name  = mysqli_real_escape_string($conn, $text_name);
        $san_text_mail = mysqli_real_escape_string($conn, $text_mail);
        $san_text_contact = mysqli_real_escape_string($conn, $text_contact);
        $san_text_address = mysqli_real_escape_string($conn, $text_address);
        
        
        
        if(!empty($text_name) && !empty($text_mail) && !empty($text_contact) && !empty($text_address)){
        
        $Add_Det = mysqli_query($conn, "INSERT INTO facility_data (name,address,contact,email) VALUES('{$san_text_name}','{$san_text_address}','{$san_text_contact}','{$san_text_mail}')");
        
        if($Add_Det){
        echo "added successfully";
        }else{
            echo "failed";
        }
        
        }else{
        echo "empty fields";
        }


    }
    


    
    ?>