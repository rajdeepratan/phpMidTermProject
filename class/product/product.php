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

    require_once "./connection/connection.php";

/**
 * Product Class use for  get, insert, update, delete
 */
    class product {

        const CODE_MAX_LENGTH = 12;
        const DESCRIPTION_MAX_LENGTH = 100;
        const PRICE_MAX_LENGTH = 7;

        private $productId = "";
        private $productCode  = "";
        private $productDescription = "";
        private $productRetailPrice	 = "";
        private $productCostPrice = "";

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
            $this->productId = $productId;
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
        public function setProductCode($productCode) {
            if(empty($productCode)) {
                return "The product code is empty";
            } else if(mb_strlen($productCode) > self::CODE_MAX_LENGTH) {
                return "The product code can not be greater than 12 char";
            } else {
                $this->productCode = $productCode;
                return null;
            }
           
        }

        /**
         * @return string
         */
        public function getProductDescription(){
            return $this->productDescription;
        }
        /**
         * @param mixed $productDescription
         * 
         * @return string
         */
        public function setProductDescription($productDescription) {
            if(empty($productDescription)) {
                return "The product description is empty";
            } else if(mb_strlen($productDescription) > self::DESCRIPTION_MAX_LENGTH) {
                return "The product description can not be greater than 100 char ";
            } else {
                $this->productDescription = $productDescription;
                return null;
            }
        }

        /**
         * @return string
         */
        public function getProductRetailPrice(){
            return $this->productRetailPrice;
        }
        /**
         * @param mixed $productRetailPrice
         * 
         * @return string
         */
        public function setProductRetailPrice($productRetailPrice) {
            $this->productRetailPrice = $productRetailPrice;
            return null;
        }

        /**
         * @return string
         */
        public function getProductCostPrice(){
            return $this->productCostPrice;
        }
        /**
         * @param mixed $productCostPrice
         * 
         * @return string
         */
        public function setProductCostPrice($productCostPrice) {
            $this->productCostPrice = $productCostPrice;
            return null;
        }

        /**
         * @param mixed $productId
         * @param mixed $productCode
         * @param mixed $productDescription
         * @param mixed $productRetailPrice
         * @param mixed $productCostPrice
         */
        public function __construct($productId, $productCode, $productDescription, $productRetailPrice, $productCostPrice) {
            
            if($productId && $productCode && $productDescription && $productRetailPrice && $productCostPrice) {
                $this->setProductId($productId);
                $this->setProductCode($productCode);
                $this->setProductDescription($productDescription);
                $this->setProductRetailPrice($productRetailPrice);
                $this->setProductCostPrice($productCostPrice);

            }

        }

        /**
         * @return string
         */
        public function createProduct(){

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pProductCode = $this->getProductCode();
            $pProductDescription = $this->getProductDescription();
            $pProductRetailPrice = $this->getProductRetailPrice();
            $pProductCostPrice = $this->getProductCostPrice();

            #stored procedure for insert new product
            $createProduct = 'Call insertProduct(?,?,?,?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($createProduct);

            #bind the parameter
            $PDOobject->bindParam(1, $pProductCode, PDO::PARAM_STR);
            $PDOobject->bindParam(2, $pProductDescription, PDO::PARAM_STR);
            $PDOobject->bindParam(3, $pProductRetailPrice, PDO::PARAM_STR);
            $PDOobject->bindParam(4, $pProductCostPrice, PDO::PARAM_STR);

            $PDOobject->execute();

            return "Product Created";
        }

        /**
         * @return string
         */
        public function getProductById(){

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pProductId = $this->getProductById();

            #stored procedure for get product by id
            $getProduct = 'Call selectOneProduct(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($getProduct);

            #bind the parameter
            $PDOobject->bindParam(1, $pProductId, PDO::PARAM_STR);

            $PDOobject->execute();
            while($row = $PDOobject->fetch()) {
                $this->setProductId($row['productId']);
                $this->setProductCode($row['productCode']);
                $this->setProductDescription($row['productDescription']);
                $this->setProductRetailPrice($row['productRetailPrice']);
                $this->setProductCostPrice($row['productCostPrice']);
            }
            
        }

        /**
         * @return string
         */
        public function updateProductById() {

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pProductId = $this->getProductById();
            $pProductCode = $this->getProductCode();
            $pProductDescription = $this->getProductDescription();
            $pProductRetailPrice = $this->getProductRetailPrice();
            $pProductCostPrice = $this->getProductCostPrice();

            #stored procedure for update product by id
            $updateProduct = 'Call updateProduct(?,?,?,?,?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($updateProduct);

            #bind the parameter
            $PDOobject->bindParam(1, $pProductId, PDO::PARAM_STR);
            $PDOobject->bindParam(2, $pProductCode, PDO::PARAM_STR);
            $PDOobject->bindParam(3, $pProductDescription, PDO::PARAM_STR);
            $PDOobject->bindParam(4, $pProductRetailPrice, PDO::PARAM_STR);
            $PDOobject->bindParam(5, $pProductCostPrice, PDO::PARAM_STR);

            $PDOobject->execute();

            return "Product Updated, Refresh the page to see it's effect";

        }

        /**
         * @return string
         */
        public function deleteProductById(){
            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pProductId = $this->getProductById();

            #stored procedure for delete product by id
            $deleteCustomer = 'Call deleteProduct(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($deleteCustomer);

            #bind the parameter
            $PDOobject->bindParam(1, $pCustomerId, PDO::PARAM_STR);

            $PDOobject->execute();

            return "Product Deleted, Refresh the page to see it's effect";
        }

    }


?>