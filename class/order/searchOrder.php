<!-- Review History -->

<!-- 

Rajdeep Ratan <rajdeepratan@hotmail.com> 1643988061 -0500	checkout: moving from master to main
Rajdeep Ratan <rajdeepratan@hotmail.com> 1643988257 -0500	commit: Project Setup
Rajdeep Ratan <rajdeepratan@hotmail.com> 1644258229 -0500	commit: Add Navbar
Rajdeep Ratan <rajdeepratan@hotmail.com> 1644263510 -0500	commit: Home Page And Footer
Rajdeep Ratan <rajdeepratan@hotmail.com> 1644594325 -0500	commit: Product Form Page
Rajdeep Ratan <rajdeepratan@hotmail.com> 1644871609 -0500	commit: Save JSON data inside the file
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645215610 -0500	commit: Add error and log function
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645470773 -0500	commit: Read orders from the data file and display them on the oder.php page
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645471547 -0500	commit: Product Page Show Error Issue Fix
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645552383 -0500	commit: Order Page GET params
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645723363 -0500	commit: Remove unwanted space
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645725035 -0500	commit: Add cheat sheet
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645725544 -0500	commit: Add cheatsheet download button
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645726429 -0500	commit: Made all the css office
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645726449 -0500	commit: Remove commented code
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645726469 -0500	commit: made DEBUGGING_MODE false
Rajdeep Ratan <rajdeepratan@hotmail.com> 1645726654 -0500	commit: Final Commit
Rajdeep Ratan <rajdeepratan@hotmail.com> 1646155532 -0500	commit: Bug fix
Rajdeep Ratan <rajdeepratan@hotmail.com> 1646613922 -0500	commit: Add link on home page adds image click
Rajdeep Ratan <rajdeepratan@hotmail.com> 1648493534 -0400	commit: Registration form
Rajdeep Ratan <rajdeepratan@hotmail.com> 1648495888 -0400	commit: Display product list from database using PDO function
Rajdeep Ratan <rajdeepratan@hotmail.com> 1649101593 -0400	commit: Create Customer Class
Rajdeep Ratan <rajdeepratan@hotmail.com> 1649428531 -0400	commit: User Registration
Rajdeep Ratan <rajdeepratan@hotmail.com> 1649707972 -0400	commit: Class
Rajdeep Ratan <rajdeepratan@hotmail.com> 1649708009 -0400	commit: Products Page
Rajdeep Ratan <rajdeepratan@hotmail.com> 1649708089 -0400	commit: Refactor user registration code
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650244282 -0400	commit: User Session
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650247273 -0400	commit: User Profile
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650257545 -0400	commit: Creating an order
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650318180 -0400	commit: Display User Order
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650330806 -0400	commit: Add all the store procedures in classes
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650331012 -0400	discard: [982db25ccda98e2401ac87387128a0398475f2a0]
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650600777 -0400	commit: Order Page
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650600926 -0400	commit: Redirect website on HTTPS
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650601391 -0400	commit: Create openssl .key and .crt file
Rajdeep Ratan <rajdeepratan@hotmail.com> 1650675269 -0400	commit: Add comments in class objects 
    
-->

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