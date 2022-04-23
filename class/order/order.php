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
 * Order Class use for  get, insert, update, delete
 */
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
        public function setOrderId($orderId) {
            $this->orderId = $orderId;
            return null;
        }

        /**
         * @return string
         */
        public function getCustomerId() {
            return $this->customerId;
        }
        /**
         * @param mixed $customerId
         * 
         * @return string
         */
        public function setCustomerId($customerId){
            if(empty($customerId)) {
                return "Need to login before placing your order";
            } else {
                $this->customerId = $customerId;
                return null;
            }
        }

        /**
         * @return string
         */
        public function getProductId() {
            return $this->productId;
        }
        /**
         * @param mixed $productId
         * 
         * @return string
         */
        public function setProductId($productId) {
            if(empty($productId)) {
                return "Select the Product";
            } else {
                $this->productId = $productId;
                return null;
            }
        }

        /**
         * @return string
         */
        public function getProductQty() {
            return $this->productQty;
        }
        /**
         * @param mixed $productQty
         * 
         * @return string
         */
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

        /**
         * @return string
         */
        public function getPrice() {
            return $this->price;
        }
        /**
         * @param mixed $price
         * 
         * @return string
         */
        public function setPrice($price) {
            if(empty($price)){
                return "Price can not be empty";
            } else {
                $this->price = $price;
            }
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
        public function setTaxesAmount($taxesAmount){
            if(empty($taxesAmount)){
                return "Taxes can not be empty";
            } else {
                $this->taxesAmount = $taxesAmount;
            }
            return null;
        }

        /**
         * @return string
         */
        public function getComments() {
            return $this->comments;
        }
        /**
         * @param mixed $comments
         * 
         * @return string
         */
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

        /**
         * @param string $orderId
         * @param string $customerId
         * @param string $productId
         * @param string $productQty
         * @param string $price
         * @param mixed $taxesAmount=""
         * @param string $comments
         */
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

        /**
         * @return string
         */
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

        /**
         * @return string
         */
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

        /**
         * @return string
         */
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

        /**
         * @return string
         */
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

            return "Order Deleted";
        }
    }

?>