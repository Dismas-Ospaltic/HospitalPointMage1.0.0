<?php
 @include 'config.php';
$select_Equipment= mysqli_query($conn, "SELECT product_name,qty FROM equipment_data ORDER BY id DESC");
if(mysqli_num_rows($select_Equipment) > 0){
 
    while($row = mysqli_fetch_assoc($select_Equipment)){
     echo '
     <label>
                <p id="single-resource">'.$row["product_name"].'</p>
                <p id="num">'.$row["qty"].'</p>
               </label>
     ';

    }
}else{
    echo '
    <section id="no-det">
    <h3>No Data Available...</h3>
    </section> 
    ';
}
?>