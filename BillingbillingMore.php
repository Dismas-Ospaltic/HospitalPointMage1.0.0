<?php
@include 'config.php';
if(isset($_GET["product_name"]) && isset($_GET["V_ID"]) && isset($_GET["INVO_NUM"]) && isset($_GET["num_det"])){
   $PRODUCT = mysqli_real_escape_string($conn, $_GET["product_name"]);
   $VISIT_ID  = mysqli_real_escape_string($conn, $_GET["V_ID"]);
   $INVO_NO = mysqli_real_escape_string($conn, $_GET["INVO_NUM"]);
    $id = mysqli_real_escape_string($conn, $_GET["num_det"]);
 
   if(isset($_POST["text_service"])){

    $product_name = $_POST['text_service'];
    $qty =  $_POST['text_qty'];
    $price = $_POST['text_price'];
    $total = $_POST['text_total'];
   
    $san_product_name = mysqli_real_escape_string($conn, $product_name);
    $san_qty= mysqli_real_escape_string($conn, $qty);
    $san_price= mysqli_real_escape_string($conn, $price);
    $san_total = mysqli_real_escape_string($conn, $total);


if(!empty($product_name) && !empty($qty) && !empty($price) && !empty($total)){
   $listExist = false;
   $select_Service = mysqli_query($conn, "SELECT * FROM invoice_list WHERE product_service='{$PRODUCT}' AND invoice_num='{$INVO_NO}' AND visit_id = '{$VISIT_ID}' AND id='{$id}' AND status='pending'");

  
   if(mysqli_num_rows($select_Service) > 0){
    $listExist = true;
    $Service_total = 0;
    while($row = mysqli_fetch_assoc($select_Service)){
    // $row = mysqli_fetch_assoc($select_Service);
    
    //  $Service = $row["product_sevice"];
    //  $Quantity =$row["qty"];
     $Service_Price =$row["price"];
     $Service_total += $row["sub_ttl"];
   }
   }else{
    $listExist = false;
   }


    


   //select gen invoice
   $GenExist = false;
   $select_Service_Gen = mysqli_query($conn, "SELECT * FROM invoice_list_gen WHERE invoice_num='{$INVO_NO}' AND visit_id = '{$VISIT_ID}' AND status='pending'");

   if(mysqli_num_rows($select_Service_Gen) > 0){
    $GenExist = true;
    $row_gen = mysqli_fetch_assoc($select_Service_Gen);

     $Grant_Total= $row_gen["total"];

   }else{
    $GenExist = false;
   }

if($listExist && $GenExist){

    $update_grand_total = ($Grant_Total - $Service_total) + $total;

    $update_List = mysqli_query($conn, "UPDATE invoice_list SET product_service='{$san_product_name}', qty='{$san_qty}', price='{$san_price}', sub_ttl='{$san_total}' WHERE product_service='{$PRODUCT}' AND invoice_num='{$INVO_NO}' AND visit_id = '{$VISIT_ID}' AND id='{$id}' AND status='pending'");

    $update_gen_List = mysqli_query($conn, "UPDATE invoice_list_gen SET total={$update_grand_total} WHERE (invoice_num='{$INVO_NO}' AND visit_id = '{$VISIT_ID}') AND status='pending'");

if($update_List && $update_gen_List){
echo "success";
}else{
echo "failed";
}

}
   }else{
     echo "empty";
   }

   }

}else{
    echo "not set";
}
?>