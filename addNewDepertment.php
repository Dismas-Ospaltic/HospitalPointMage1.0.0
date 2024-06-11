<?php
@include 'config.php';

$dept_name= $_POST["text_dept"];

if(!empty($dept_name)){
    $san_dept_name=mysqli_real_escape_string($conn, $dept_name);

    $select_dept = mysqli_query($conn, "SELECT * FROM department_data WHERE dept_name = '{$san_dept_name}'");
   if (mysqli_num_rows($select_dept) > 0) { 
        echo "exist";
    }else{
        $add_dept = mysqli_query($conn, "INSERT INTO department_data (dept_name) VALUES('{$san_dept_name}')");
       if($add_dept){
   echo "added";
       }else{
        echo "add fail";
       }

    }

}else{
    echo "empty";
}





?>