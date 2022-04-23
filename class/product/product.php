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