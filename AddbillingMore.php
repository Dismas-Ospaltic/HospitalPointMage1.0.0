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

if(isset($_GET["HSPN"]) && isset($_GET["ODPIDP"])){

$hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
$DP_NO = mysqli_real_escape_string($conn, $_GET["ODPIDP"]);

///select visit id

$VisitIDisset =false;

$select_visit_id = mysqli_query($conn, "SELECT visit_id FROM patient_sub_visit WHERE (hospital_patient_no='{$hospital_unique}' OR odp_idp_no='{$DP_NO}') AND status='not_tend' LIMIT 1");
if(mysqli_num_rows($select_visit_id) > 0){
    $VisitIDisset =true;
    $row_inner = mysqli_fetch_assoc($select_visit_id);
    $visit_id = $row_inner["visit_id"];
}else{
    $VisitIDisset =false;   
}

//@end

if($VisitIDisset){

$general_invoice = false;


///select if existing
$select_invoice_gen =mysqli_query($conn, "SELECT * FROM invoice_list_gen WHERE hospital_patient_no = '{$hospital_unique}' AND visit_id='{$visit_id}' AND status='pending'");
if(mysqli_num_rows($select_invoice_gen) > 0){
$row_gen = mysqli_fetch_assoc($select_invoice_gen);

$general_invoice = true;

$invoce_num_to_add =$row_gen["invoice_num"];
$invoice_total = $row_gen["total"];

///select add invo list
$select_add_invList = mysqli_query($conn, "SELECT SUM(sub_ttl) AS Total_invo FROM invoice_list WHERE hospital_patient_no = '{$hospital_unique}' AND visit_id='{$visit_id}' AND status='pending'");
if (mysqli_num_rows($select_add_invList) > 0) { 
    $row_total = mysqli_fetch_assoc($select_add_invList);
        $totalInvoice = $row_total['Total_invo'] + 0;
}
else{
    $totalInvoice = 0;
}
//@end

}else{

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
if(!$general_invoice){
    $invoce_num_to_add = $invoice_num_gen;
//update

foreach($product_name as $key => $p_name) {
    $quantity = $qty[$key];
    $pprice = $price[$key];
    $ptotal = $total[$key];

    $sanitizedproduct_name = mysqli_real_escape_string($conn, $p_name);
    $sanitizedqty= mysqli_real_escape_string($conn, $quantity);
    $sanitizedprice = mysqli_real_escape_string($conn, $pprice);
    $sanitizedtotal = mysqli_real_escape_string($conn, $ptotal);

    $insert_service = mysqli_query($conn, "INSERT INTO invoice_list(hospital_patient_no,product_service,qty,price,sub_ttl,invoice_num,invoice_date,invoice_time,add_by,visit_id)
    VALUES('{$hospital_unique}','{$sanitizedproduct_name}','{$sanitizedqty}','{$sanitizedprice}','{$sanitizedtotal}','{$invoce_num_to_add}','{$current_date}','{$Inv_time}','{$user}','{$visit_id}')");
  
}


if($insert_service){
    $insert_service_general = mysqli_query($conn, "INSERT INTO invoice_list_gen(invoice_num,print_by,total,invoice_date,invoice_time,visit_id,hospital_patient_no)
    VALUES('{$invoce_num_to_add}','{$user}','{$san_grand_total}','{$current_date}','{$Inv_time}','{$visit_id}','{$hospital_unique}')");
  if($insert_service_general){
  echo "success";
  }else{
    echo "failed 1";
  }
}else{
    echo "failed";
}

}else{

   
//add new to genneral invo
foreach($product_name as $key => $p_name) {
    $quantity = $qty[$key];
    $pprice = $price[$key];
    $ptotal = $total[$key];

    $sanitizedproduct_name = mysqli_real_escape_string($conn, $p_name);
    $sanitizedqty= mysqli_real_escape_string($conn, $quantity);
    $sanitizedprice = mysqli_real_escape_string($conn, $pprice);
    $sanitizedtotal = mysqli_real_escape_string($conn, $ptotal);

    $insert_service = mysqli_query($conn, "INSERT INTO invoice_list(hospital_patient_no,product_service,qty,price,sub_ttl,invoice_num,invoice_date,invoice_time,add_by,visit_id)
    VALUES('{$hospital_unique}','{$sanitizedproduct_name}','{$sanitizedqty}','{$sanitizedprice}','{$sanitizedtotal}','{$invoce_num_to_add}','{$current_date}','{$Inv_time}','{$user}','{$visit_id}')");
  
}


if($insert_service){

$total_amount_update = $totalInvoice + $san_grand_total;

$Update_service_general = mysqli_query($conn, "UPDATE invoice_list_gen SET print_by='{$user}',total = '{$total_amount_update}',invoice_date='{$current_date}',invoice_time='{$Inv_time}' WHERE (invoice_num='{$invoce_num_to_add}' OR visit_id = '{$visit_id}') AND status='pending'");
  if($Update_service_general){
  echo "success";
  }else{
    echo "failed 1";
  }
}else{
    echo "failed";
}
 
}
}else{
    echo "empty";
}
}

}else{
    echo "no visit id";
}

}else{
echo "not set";
}

?>