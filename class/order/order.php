<?php

    require_once "connection/connection.php";

    class order {

        const QUANTITY_MAX_LENGTH = 999;
        const COMMENT_MAX_LENGTH = 200;

        private $orderId = "";
        private $customerId = "";
        private $productId = "";
        private $productQty = "";
        private $price = "";
        private $taxesAmount = "";
        private $comments = "";

        public function getOrderId() {
            return $this->orderId;
        }
        public function setOrderId($orderId) {
            $this->orderId = $orderId;
            return null;
        }

        public function getCustomerId() {
            return $this->customerId;
        }
        public function setCustomerId($customerId){
            if(empty($customerId)) {
                return "Need to login before placing your order";
            } else {
                $this->customerId = $customerId;
                return null;
            }
        }

        public function getProductId() {
            return $this->productId;
        }
        public function setProductId($productId) {
            if(empty($productId)) {
                return "Select the Product";
            } else {
                $this->productId = $productId;
                return null;
            }
        }

        public function getProductQty() {
            return $this->productQty;
        }
        public function setProductQty($productQty) {
            if(empty($productQty)){
                return "Enter the quantity";
            } else if(mb_strlen($productQty) > self::QUANTITY_MAX_LENGTH) {
                return "Quantity can not be more than 999/order";
            } else {
                $this->productQty = $productQty;
                return null;
            }
        }

        public function getPrice() {
            return $this->price;
        }
        public function setPrice($price) {
            if(empty($price)){
                return "Price can not be empty";
            } else {
                $this->price = $price;
            }
            return null;
        }

        public function getTaxesAmount(){
            return $this->taxesAmount;
        }
        public function setTaxesAmount($taxesAmount){
            if(empty($taxesAmount)){
                return "Taxes can not be empty";
            } else {
                $this->taxesAmount = $taxesAmount;
            }
            return null;
        }

        public function getComments() {
            return $this->comments;
        }
        public function setComments($comments) {
            if(!empty($comments)){
                if(mb_strlen($comments) > self::COMMENT_MAX_LENGTH) {
                    return "Comment can be more than 200 char";
                } else {
                    $this->comments = $comments;
                    return null;
                }
            }
        }

        public function __construct($orderId = "", $customerId = "", $productId = "", $productQty = "", $price = "", $taxesAmount="", $comments = "")  {

            if($orderId){
                $this->setOrderId($orderId);
            }
            if($customerId) {
                $this->setCustomerId($customerId);
            }

            if($productId) {
                $this->setProductId($productId);
            }

            if($productQty){
                $this->setProductQty($productQty);
            }

            if($price){
                $this->setPrice($price);
            }

            if($taxesAmount){
                $this->setTaxesAmount($taxesAmount);
            }

            if($comments){
                $this->setComments($comments);
            }

        }

        public function createOrder(){

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pCustomerId = $this->getCustomerId();
            $pProductId = $this->getProductId();
            $pProductQty = $this->getProductQty();
            $pPrice = $this->getPrice();
            $pTaxesAmount = $this->getTaxesAmount();
            $pComments = $this->getComments();

            #stored procedure for insert new order
            $createOrder = 'Call insertOrder(?,?,?,?,?,?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($createOrder);

            #bind the parameter
            $PDOobject->bindParam(1, $pCustomerId, PDO::PARAM_STR);
            $PDOobject->bindParam(2, $pProductId, PDO::PARAM_STR);
            $PDOobject->bindParam(3, $pProductQty, PDO::PARAM_STR);
            $PDOobject->bindParam(4, $pPrice, PDO::PARAM_STR);
            $PDOobject->bindParam(5, $pTaxesAmount, PDO::PARAM_STR);
            $PDOobject->bindParam(6, $pComments, PDO::PARAM_STR);

            $PDOobject->execute();

            return "Order Created";
            
        }

        public function getOrderById(){

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pOrderId = $this->getOrderId();

            #stored procedure for select order by id
            $getOrder = 'Call selectOneOrder(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($getOrder);

            #bind the parameter
            $PDOobject->bindParam(1, $pOrderId, PDO::PARAM_STR);

            $PDOobject->execute();

            while($row = $PDOobject->fetch()) {
                $this->setOrderId($row['orderId']);
                $this->setCustomerId($row['customerId']);
                $this->setProductId($row['productId']);
                $this->setProductQty($row['productQty']);
                $this->setPrice($row['price']);
                $this->setTaxesAmount($row['taxesAmount']);
                $this->setComments($row['comments']);
            }
        }

        public function updateOrderById(){

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pOrderId = $this->getOrderId();

            #stored procedure for update order by id
            $updateOrder = 'Call updateOrder(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($updateOrder);

            #bind the parameter
            $PDOobject->bindParam(1, $pOrderId, PDO::PARAM_STR);
            $PDOobject->bindParam(2, $pCustomerId, PDO::PARAM_STR);
            $PDOobject->bindParam(3, $pProductId, PDO::PARAM_STR);
            $PDOobject->bindParam(4, $pProductQty, PDO::PARAM_STR);
            $PDOobject->bindParam(5, $pPrice, PDO::PARAM_STR);
            $PDOobject->bindParam(6, $pTaxesAmount, PDO::PARAM_STR);
            $PDOobject->bindParam(7, $pComments, PDO::PARAM_STR);

            $PDOobject->execute();

            return "Order Updated, Refresh the page to see it's effect";
        }

        public function deleteOrderById(){

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pOrderId = $this->getOrderId();

            #stored procedure for delete order by id
            $deleteOrder = 'Call deleteOrder(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($deleteOrder);
             
            #bind the parameter
            $PDOobject->bindParam(1, $pOrderId, PDO::PARAM_STR);

            

            $PDOobject->execute();

            return "Order Deleted, Refresh the page to see it's effect";
        }
    }

?>