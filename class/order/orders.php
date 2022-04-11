<?php

class orders extends collection {

    function __construct() {
       
        #setting up the connection
        global $connection;

        #stored procedure for getting all the products
        $getOrdersList = 'Call select_all_orders()';

        #execute the SQL statement
        $PDOobject = $connection->prepare($getOrdersList);

        $PDOobject->execute();

        while($row = $PDOobject->fetch(PDO::FETCH_ASSOC)){
            $order = new order($row["orderId"], $row["customerId"], $row["productId"], $row["productQty"], $row["price"], $row["comments"]);
            $this->add($row["orderId"], $order);

        }

    }
}


?>