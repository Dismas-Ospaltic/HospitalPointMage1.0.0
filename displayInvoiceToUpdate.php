<?php
@include 'config.php';
if(isset($_GET["product_name"]) && isset($_GET["V_ID"]) && isset($_GET["INVO_NUM"])){
   $PRODUCT = mysqli_real_escape_string($conn, $_GET["product_name"]);
   $VISIT_ID  = mysqli_real_escape_string($conn, $_GET["V_ID"]);
   $INVO_NO = mysqli_real_escape_string($conn, $_GET["INVO_NUM"]);



   $select_single_det =mysqli_query($conn, "SELECT * FROM invoice_list WHERE product_service='{$PRODUCT}' AND (visit_id ='{$VISIT_ID}' OR invoice_num='{$INVO_NO}')");

   if(mysqli_num_rows($select_single_det) > 0){
      $row =mysqli_fetch_assoc($select_single_det);

  echo '
  <form action="#" method="post">
  <div class="input-wrapper">
   <label>Service/Product *</label>
 <input type="text" name="text_service" placeholder="please enter service or product name..." value="'.$row["product_service"].'">
  </div> 

  <div class="input-wrapper">
   <label>Qty *</label>
   <input type="number" class="txt_qty" name="text_qty" min="1" placeholder="please enter service or product quantity..." value="'.$row["qty"].'">
  </div>

  <div class="input-wrapper">
   <label>Price *</label>
   <input type="number" class="txt_price" name="text_price" placeholder="please enter service or product Price..." value="'.$row["price"].'">
  </div>

  <div class="input-wrapper">
   <label>Total *</label>
   <input type="number" class="txt_total" name="text_total" placeholder="total..." value="'.$row["sub_ttl"].'" readonly>
  </div>


  <div class="btn-wrapper">
   <button class="save-btn" onclick="EditServiceBillingInvoice()"><i class="fa-solid fa-edit"></i>Save Changes</button>
  </div>
 </form>
  '; 


   }else{
    echo "No data to Show...";
   }
}else{
    echo "not set";
}

   ?>