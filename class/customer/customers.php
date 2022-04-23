<?php

/**
 * Customers class for getting all the list for customers
 */
class customers extends collection {

    /**
     */
    function __construct(){

        #setting up the connection
        global $connection;

        #stored procedure for getting all the products
        $getCustomerList = 'Call selectAllCustomers()';

        #execute the SQL statement
        $PDOobject = $connection->prepare($getCustomerList);

        $PDOobject->execute();

        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC)){
            $customer = new customer($row["customerId"], $row["firstName"], $row["lastName"], $row["address"], $row["city"], $row["province"], $row["postalCode"], $row["userName"], $row["password"], $row["picture"]);
            $this->add($row["customerId"], $customer);
        }

    }

}


?>