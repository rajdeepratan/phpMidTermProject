<?php 

    require_once "./connection/connection.php";

    class product {

        const CODE_MAX_LENGTH = 12;
        const DESCRIPTION_MAX_LENGTH = 100;
        const PRICE_MAX_LENGTH = 7;

        private $productId = "";
        private $productCode  = "";
        private $productDescription = "";
        private $productRetailPrice	 = "";
        private $productCostPrice = "";

        public function getProductId() {
            return $this->productId;
        }
        protected function setProductId($productId) {
            $this->productId = $productId;
            return null;
        }

        public function getProductCode(){
            return $this->productCode;
        }
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

        public function getProductDescription(){
            return $this->productDescription;
        }
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

        public function getProductRetailPrice(){
            return $this->productRetailPrice;
        }
        public function setProductRetailPrice($productRetailPrice) {
            $this->productRetailPrice = $productRetailPrice;
            return null;
        }

        public function getProductCostPrice(){
            return $this->productCostPrice;
        }
        public function setProductCostPrice($productCostPrice) {
            $this->productCostPrice = $productCostPrice;
            return null;
        }

        public function __construct($productId, $productCode, $productDescription, $productRetailPrice, $productCostPrice) {
            
            if($productId && $productCode && $productDescription && $productRetailPrice && $productCostPrice) {
                $this->setProductId($productId);
                $this->setProductCode($productCode);
                $this->setProductDescription($productDescription);
                $this->setProductRetailPrice($productRetailPrice);
                $this->setProductCostPrice($productCostPrice);

            }

        }

        public function createProduct(){

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pProductCode = $this->getProductCode();
            $pProductDescription = $this->getProductDescription();
            $pProductRetailPrice = $this->getProductRetailPrice();
            $pProductCostPrice = $this->getProductCostPrice();

            #stored procedure for insert new product
            $create = 'Call insert_product(?,?,?,?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($create);

            #bind the parameter
            $PDOobject->bindParam(1, $pProductCode, PDO::PARAM_STR);
            $PDOobject->bindParam(2, $pProductDescription, PDO::PARAM_STR);
            $PDOobject->bindParam(3, $pProductRetailPrice, PDO::PARAM_STR);
            $PDOobject->bindParam(4, $pProductCostPrice, PDO::PARAM_STR);

            $PDOobject->execute();

            return "Product Created";
        }

        public function updateProduct() {

            #setting up the connection
            global $connection;

        }

        public function getProductById(){

            #setting up the connection
            global $connection;
            
        }
    }


?>