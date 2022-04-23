<?php

    require_once "connection/connection.php";

/**
 * Order Search Class 
 */
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

        /**
         * @return string
         */
        public function getOrderId() {
            return $this->orderId;
        }
        /**
         * @param mixed $orderId
         * 
         * @return string
         */
        protected function setOrderId($orderId) {
            $this->orderId = $orderId;
            return null;
        }

        /**
         * @return string
         */
        public function getCreatedAt(){
            return $this->createdAt;
        }
        /**
         * @param mixed $createdAt
         * 
         * @return string
         */
        protected function setCreatedAt($createdAt) {
            $this->createdAt = $createdAt;
            return null;
        }

        /**
         * @return string
         */
        public function getProductCode(){
            return $this->productCode;
        }
        /**
         * @param mixed $productCode
         * 
         * @return string
         */
        protected function setProductCode($productCode){
            $this->productCode = $productCode;
            return null;
        }

        /**
         * @return string
         */
        public function getFirstName(){
            return $this->firstName;
        }
        /**
         * @param mixed $firstName
         * 
         * @return string
         */
        protected function setFirstName($firstName){
            $this->firstName= $firstName;
            return null;
        }

        /**
         * @return string
         */
        public function getLastName(){
            return $this->lastName;
        }
        /**
         * @param mixed $lastName
         * 
         * @return string
         */
        protected function setLastName($lastName){
            $this->lastName = $lastName;
            return null;
        }
        
        /**
         * @return string
         */
        public function getCity(){
            return $this->city;
        }
        /**
         * @param mixed $city
         * 
         * @return string
         */
        protected function setCity($city){
            $this->city = $city;
            return null;
        }

        /**
         * @return string
         */
        public function getComments(){
            return $this->comments;
        }
        /**
         * @param mixed $comments
         * 
         * @return string
         */
        protected function setComments($comments){
            $this->comments = $comments;
            return null;
        }

        /**
         * @return string
         */
        public function getPrice(){
            return $this->price;
        }
        /**
         * @param mixed $price
         * 
         * @return string
         */
        protected function setPrice($price){
            $this->price = $price;
            return null;
        }

        /**
         * @return string
         */
        public function getProductQty(){
            return $this->productQty;
        }
        /**
         * @param mixed $productQty
         * 
         * @return string
         */
        protected function setProductQty($productQty){
            $this->productQty = $productQty;
            return null;
        }

        /**
         * @return string
         */
        public function getTaxesAmount(){
            return $this->taxesAmount;
        }
        /**
         * @param mixed $taxesAmount
         * 
         * @return string
         */
        protected function setTaxesAmount($taxesAmount){
            $this->taxesAmount = $taxesAmount;
            return null;
        }

        /**
         * @param string $orderId
         * @param string $createdAt
         * @param string $productCode
         * @param string $firstName
         * @param string $lastName
         * @param string $city
         * @param string $comments
         * @param string $price
         * @param string $productQty
         * @param string $taxesAmount
         */
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