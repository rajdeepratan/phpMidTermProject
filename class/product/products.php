<?php

class products extends collection {

    function __construct(){

        #setting up the connection
        global $connection;

        #stored procedure for getting all the products
        $getProductsList = 'Call selectAllProduct()';

        #execute the SQL statement
        $PDOobject = $connection->prepare($getProductsList);

        $PDOobject->execute();

        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC)){
            $product = new product($row["productId"], $row["productCode"], $row["productDescription"], $row["productRetailPrice"], $row["productCostPrice"]);
            $this->add($row["productId"], $product);

        }

    }

}


?>