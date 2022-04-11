<?php

class customers extends collection {

    function __construct(){

        #setting up the connection
        global $connection;

        #stored procedure for getting all the products
        $getProductsList = 'Call select_all_customers()';

        #execute the SQL statement
        $PDOobject = $connection->prepare($getProductsList);

        $PDOobject->execute();

        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC)){
            $customer = new customer($row["customerId"], $row["firstName"], $row["lastName"], $row["address"], $row["city"], $row["province"], $row["postalCode"], $row["userName"], $row["password"], $row["picture"]);
            $this->add($row["customerId"], $customer);

        }

    }

}


?>