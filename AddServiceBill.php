<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");

// select user
if(!isset($_COOKIE['text_role_hms']) && !isset($_COOKIE['text_mail_hms'])){
    header("Location:  Login.php");
    }
    
    $_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
    $_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];
    
    $session_user=$_SESSION['text_mail_hms'];
    $session_role=$_SESSION['text_role_hms'];
    
    if($session_role == "admin"){
    $select_admin_det = mysqli_query($conn, "SELECT * FROM admin_data WHERE email_address='{$session_user}'");
    if(mysqli_num_rows($select_admin_det) > 0){
      $row = mysqli_fetch_assoc($select_admin_det);
      $role = $row["role"];
      $adminName = $row["first_name"]." - ".$role;
     
    }else{
        $adminName = "no log";
    }
    }else{
      $select_other_det = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address='{$session_user}'");
    if(mysqli_num_rows($select_other_det) > 0){
      $row = mysqli_fetch_assoc($select_other_det);
      $role = $row["role"];
      $adminName = $row["first_name"]." - ".$role;
    }else{
        $adminName = "no log";
    }
    }

 
$user = $adminName;

$time = time();
$invoice_num_gen = rand(time(), 1000000);
$Inv_time = date('H:i:s', time());


if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"]) && isset($_GET["V_ID"])){

    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);
    $Visit_id = mysqli_real_escape_string($conn, $_GET["V_ID"]);






    $ifAdded = false;
    $select_if_added = mysqli_query($conn, "SELECT * FROM invoice_list WHERE hospital_patient_no='{$hospital_unique}' AND visit_id='{$Visit_id}' AND status='pending'");
    if(mysqli_num_rows($select_if_added) > 0){
        $ifAdded = true;
    }else{
        $ifAdded = false;
    }
    
    if(isset($_POST["pname"])){
    $product_name = $_POST['pname'];
    $qty =  $_POST['qty'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $grand_total = $_POST['grand_total'];

    $san_grand_total= mysqli_real_escape_string($conn, $grand_total);



      $empty = true;

    foreach($product_name as $key => $p_name) {

        $quantity = $qty[$key];
        $pprice = $price[$key];
        if(!empty($p_name) && !empty($quantity) && !empty($pprice)){
            $empty = false;
        }else{
            $empty = true;
        }
    }
   


    if(!$empty){
    if(!$ifAdded){
      
    foreach($product_name as $key => $p_name) {

        $quantity = $qty[$key];
        $pprice = $price[$key];
        $ptotal = $total[$key];
    
        $sanitizedproduct_name = mysqli_real_escape_string($conn, $p_name);
        $sanitizedqty= mysqli_real_escape_string($conn, $quantity);
        $sanitizedprice = mysqli_real_escape_string($conn, $pprice);
        $sanitizedtotal = mysqli_real_escape_string($conn, $ptotal);

        $insert_service = mysqli_query($conn, "INSERT INTO invoice_list(hospital_patient_no,product_service,qty,price,sub_ttl,invoice_num,invoice_date,invoice_time,add_by,visit_id)
        VALUES('{$hospital_unique}','{$sanitizedproduct_name}','{$sanitizedqty}','{$sanitizedprice}','{$sanitizedtotal}','{$invoice_num_gen}','{$current_date}','{$Inv_time}','{$user}','{$Visit_id}')");
      
    }
    if($insert_service){
        $insert_service_general = mysqli_query($conn, "INSERT INTO invoice_list_gen(invoice_num,print_by,total,invoice_date,invoice_time,visit_id,hospital_patient_no)
        VALUES('{$invoice_num_gen}','{$user}','{$san_grand_total}','{$current_date}','{$Inv_time}','{$Visit_id}','{$hospital_unique}')");
      if($insert_service_general){
      echo "success";
      }else{
        echo "failed 1";
      }
    }else{
        echo "failed";
    }
   
    }else{
        echo "already added";
        //al pick invo num
    }
}else{
    echo "empty";
}
}

}else{
    echo "not set";
}

?>