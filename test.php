<?php 

if(isset($_COOKIE['offline_back_triger'])){

    echo $_COOKIE['offline_back_triger'];
    }else{
        echo "no cookie";
    }
?>