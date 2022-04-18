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
        protected function setOrderId($orderId) {
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
                $this->orderId = $orderId;
            }
            if($customerId) {
                $this->customerId = $customerId;
            }

            if($productId) {
                $this->productId = $productId;
            }

            if($productQty){
                $this->productQty = $productQty;
            }

            if($price){
                $this->price = $price;
            }

            if($taxesAmount){
                $this->taxesAmount = $taxesAmount;
            }

            if($comments){
                $this->comments = $comments;
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

            #stored procedure for insert new customer
            $create = 'Call insertOrder(?,?,?,?,?,?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($create);

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
    }

?>