<?php

    $connection = new PDO("mysql:host=localhost;dbname=database_2110167", 'root', '');
    #to raise an exception when there is an error in your sql queries
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #to protect my code against SQL injection
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
?>