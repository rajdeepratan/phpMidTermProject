<?php
    include_once "./phpFunction/functionProducts.php";

    pageTop("Logout");

    session_destroy();

    if(!headers_sent()){
        header("Location:".FILE_INDEX);
        exit;
    } 
    else {
        echo "<script type='text/javascript'> location.href='".FILE_INDEX."'; </script>";
    }    
    
?>