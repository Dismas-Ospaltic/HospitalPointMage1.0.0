<?php
@include 'config.php';
if(isset($_GET["product_name"]) && isset($_GET["V_ID"]) && isset($_GET["INVO_NUM"]) && isset($_GET["num_det"])){
   $PRODUCT = mysqli_real_escape_string($conn, $_GET["product_name"]);
   $VISIT_ID  = mysqli_real_escape_string($conn, $_GET["V_ID"]);
   $INVO_NO = mysqli_real_escape_string($conn, $_GET["INVO_NUM"]);
   $id = mysqli_real_escape_string($conn, $_GET["num_det"]);

   $listExist = false;
   $select_Service = mysqli_query($conn, "SELECT * FROM invoice_list WHERE product_service='{$PRODUCT}' AND (invoice_num='{$INVO_NO}' OR visit_id = '{$VISIT_ID}') AND id='{$id}'");

   if(mysqli_num_rows($select_Service) > 0){
    $listExist = true;
 
    $service_sub_ttl =0;

    while($row = mysqli_fetch_assoc($select_Service)){
    
    //  $Service = $row["product_sevice"];
    //  $Quantity =$row["qty"];
     $Service_Price =$row["price"];
     $Service_total =$row["sub_ttl"];
     $service_sub_ttl += $row["sub_ttl"];
   }
   
   }else{
    $listExist = false;
   }
   //select gen invoice
   $GenExist = false;
   $select_Service_Gen = mysqli_query($conn, "SELECT * FROM invoice_list_gen WHERE invoice_num='{$INVO_NO}' AND visit_id = '{$VISIT_ID}'");

   if(mysqli_num_rows($select_Service_Gen) > 0){
    $GenExist = true;
    $row_gen = mysqli_fetch_assoc($select_Service_Gen);

     $Grant_Total= $row_gen["total"];

   }else{
    $GenExist = false;
   }


if($listExist && $GenExist){

    $update_grand_total = ($Grant_Total - $service_sub_ttl);

    $delete_Service = mysqli_query($conn, "DELETE FROM invoice_list WHERE product_service='{$PRODUCT}' AND (invoice_num='{$INVO_NO}' OR visit_id = '{$VISIT_ID}') AND id='{$id}'");


if($delete_Service){
  $update_gen_List = mysqli_query($conn, "UPDATE invoice_list_gen SET total={$update_grand_total} WHERE invoice_num='{$INVO_NO}' AND visit_id = '{$VISIT_ID}'");
  if($update_gen_List){
  echo "success";
  }else{
    echo "failed";
  }
}else{
echo "failed";
}

} else{

} 

}else{
    echo "not set";
}
?>