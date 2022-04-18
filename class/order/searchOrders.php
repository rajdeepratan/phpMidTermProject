<?php

    class searchOrders extends collection {
        
        function __construct() {

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pCustomerId = $_SESSION['customerId'];

            #stored procedure for insert new customer
            $searchOrderList = 'Call searchOrder(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($searchOrderList);

            #bind the parameter
            $PDOobject->bindParam(1, $pCustomerId, PDO::PARAM_STR);

            $PDOobject->execute();

            // var_dump($PDOobject->fetch(PDO::FETCH_ASSOC));

            while($row = $PDOobject->fetch(PDO::FETCH_ASSOC)){
            //     echo $row["orderId"] $row["createdAt"] $row["productCode"] $row["firstName"] $row["lastName"] $row["city"] $row["comments"] $row["price"] $row["taxesAmount"];
            //     echo "<br>";
                $searchOrder = new searchOrder($row["orderId"], $row["createdAt"], $row["productCode"], $row["firstName"], $row["lastName"], $row["city"], $row["comments"], $row["price"], $row["productQty"], $row["taxesAmount"]);
                $this->add($row["orderId"], $searchOrder);
            }

        }
    }

?>