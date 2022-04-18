<?php

    require_once "connection/connection.php";

    class searchOrder {

        private $orderId = "";
        private $createdAt = "";
        private $productCode = "";
        private $firstName = "";
        private $lastName = "";
        private $city = "";
        private $comments = "";
        private $price = "";
        private $productQty = "";
        private $taxesAmount = "";

        public function getOrderId() {
            return $this->orderId;
        }
        protected function setOrderId($orderId) {
            $this->orderId = $orderId;
            return null;
        }

        public function getCreatedAt(){
            return $this->createdAt;
        }
        protected function setCreatedAt($createdAt) {
            $this->createdAt = $createdAt;
            return null;
        }

        public function getProductCode(){
            return $this->productCode;
        }
        protected function setProductCode($productCode){
            $this->productCode = $productCode;
            return null;
        }

        public function getFirstName(){
            return $this->firstName;
        }
        protected function setFirstName($firstName){
            $this->firstName= $firstName;
            return null;
        }

        public function getLastName(){
            return $this->lastName;
        }
        protected function setLastName($lastName){
            $this->lastName = $lastName;
            return null;
        }
        
        public function getCity(){
            return $this->city;
        }
        protected function setCity($city){
            $this->city = $city;
            return null;
        }

        public function getComments(){
            return $this->comments;
        }
        protected function setComments($comments){
            $this->comments = $comments;
            return null;
        }

        public function getPrice(){
            return $this->price;
        }
        protected function setPrice($price){
            $this->price = $price;
            return null;
        }

        public function getProductQty(){
            return $this->productQty;
        }
        protected function setProductQty($productQty){
            $this->productQty = $productQty;
            return null;
        }

        public function getTaxesAmount(){
            return $this->taxesAmount;
        }
        protected function setTaxesAmount($taxesAmount){
            $this->taxesAmount = $taxesAmount;
            return null;
        }

        public function __construct($orderId = "", $createdAt = "", $productCode = "", $firstName = "", $lastName = "", $city = "", $comments = "", $price = "", $productQty = "", $taxesAmount = ""){

            if($orderId){
                $this->setOrderId($orderId);
            }
            if($createdAt){
                $this->setCreatedAt($createdAt);
            }
            if($productCode){
                $this->setProductCode($productCode);
            }
            if($firstName){
                $this->setFirstName($firstName);
            }
            if($lastName){
                $this->setLastName($lastName);
            }
            if($city){
                $this->setCity($city);
            }
            if($comments){
                $this->setComments($comments);
            }
            if($price){
                $this->setPrice($price);
            }
            if($productQty){
                $this->setProductQty($productQty);
            }
            if($taxesAmount){
                $this->setTaxesAmount($taxesAmount);
            }
        }
        
    }

?>