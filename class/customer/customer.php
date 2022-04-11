<?php 

    require_once "connection/connection.php";

    class customer {

        const NAME_MAX_LENGTH = 20;
        const ADDRESS_MAX_LENGTH = 25;
        const POSTAL_MAX_LENGTH = 7;
        const USERNAME_MAX_LENGTH = 15;
        const PASSWORD_MAX_LENGTH = 255;
        
        private $customerId = "";
        private $firstName = "";
        private $lastName = "";
        private $address = "";
        private $city = "";
        private $province = "";
        private $postalCode = "";
        private $userName = "";
        private $password = "";
        private $picture;

        public function getCustomerId() {
            return $this->customerId;
        }
        protected function setCustomerId($customerId) {
            $this->customerId = $customerId;
            return null;
        }

        public function getFirstName() {
            return $this->firstName;
        }
        public function setFirstName($firstName) {
            if(empty($firstName)) {
                return "The first name is empty";
            } else if(mb_strlen($firstName) > self::NAME_MAX_LENGTH) {
                return "This first name is greater than 20 char";
            } else {
                $this->firstName = htmlspecialchars($firstName);
                return null;
            }
        }

        public function getLastName() {
            return $this->lastName;
        }
        public function setLastName($lastName) {
            if(empty($lastName)) {
                return "The last name is empty";
            } else if(mb_strlen($lastName) > self::NAME_MAX_LENGTH) {
                return "This last name is greater than 20 char";
            } else {
                $this->lastName = htmlspecialchars($lastName);
                return null;
            }
        }

        public function getAddress() {
            return $this->address;
        }
        public function setAddress($address) {
            if(empty($address)) {
                return "The address is empty";
            } else if(mb_strlen($address) > self::ADDRESS_MAX_LENGTH) {
                return "This address is greater than 25 char";
            } else {
                $this->address = htmlspecialchars($address);
                return null;
            }
        }

        public function getCity() {
            return $this->city;
        }
        public function setCity($city) {
        if(empty($city)) {
                return "The city is empty";
            } else if(mb_strlen($city) > self::ADDRESS_MAX_LENGTH) {
                return "This city is greater than 25 char";
            } else {
                $this->city = htmlspecialchars($city);
                return null;
            }
        }

        public function getProvince() {
            return $this->province;
        }
        public function setProvince($province) {
            if(empty($province)) {
                return "The province is empty";
            } else if(mb_strlen($province) > self::ADDRESS_MAX_LENGTH) {
                return "This province is greater than 25 char";
            } else {
                $this->province = htmlspecialchars($province);
                return null;
            }
        }
        
        public function getPostalCode() {
            return $this->postalCode;
        }
        public function setPostalCode($postalCode) {
            if(empty($postalCode)) {
                return "The postalCode is empty";
            } else if(mb_strlen($postalCode) > self::POSTAL_MAX_LENGTH) {
                return "This postalCode is greater than 7 char";
            } else {
                $this->postalCode = htmlspecialchars($postalCode);
                return null;
            }
        }

        public function getUserName() {
            return $this->userName;
        }
        public function setUserName($userName) {
            if(empty($userName)) {
                return "The user name is empty";
            } else if(mb_strlen($userName) > self::USERNAME_MAX_LENGTH) {
                return "The user name can not be greater than 15 char";
            } else {
                $this->userName = htmlspecialchars($userName);
                return null;
            }
        }
        
        public function getPassword() {
            return $this->password;
        }
        public function setPassword($password) {
            if(empty($password)) {
                return "The password is empty";
            } else if(mb_strlen($password) > self::PASSWORD_MAX_LENGTH) {
                return "This password can not greater than 255 char";
            } else {
                $userPassword = htmlspecialchars($password);
                $this->password = password_hash($userPassword, PASSWORD_DEFAULT);
                return null;
            }
        }
        
        public function getPicture() {
            return $this->picture;
        }
        public function setPicture($profilePicture) {
            if($_FILES[$profilePicture]["error"] == UPLOAD_ERR_OK && is_uploaded_file($_FILES[$profilePicture]['tmp_name'])) {

                if(($_FILES[$profilePicture]["type"] == "image/gif") 
                    || ($_FILES[$profilePicture]["type"] == "image/jpeg")
                    || ($_FILES[$profilePicture]["type"] == "image/png")
                    || ($_FILES[$profilePicture]["type"] == "image/pjpeg")) 
                {
                    $this->picture = file_get_contents($_FILES[$profilePicture]["tmp_name"]);
                    return null;
                } else if($_FILES[$profilePicture]["size"] > 16000000) {
                    return "File size can not be more than 16MB";
                } else if($_FILES[$profilePicture]["size"] === 0) {
                    return "File size can not be zero";
                } else {
                    return "Only upload image file with gif, jpeg, png or pjpeg type.";
                }
            } else {
            return "Please upload the file";
            }
        }

        public function __construct($customerId = "", $firstName = "", $lastName = "", $address = "", $city = "", $province = "", $postalCode = "", $userName = "", $password = "", $picture = "") {
            
                if($customerId && $firstName && $lastName && $address && $city && $province && $postalCode && $userName && $password && $picture) {
                    $this->setCustomerId($customerId);
                    $this->setFirstName($firstName);
                    $this->setLastName($lastName);
                    $this->setAddress($address);
                    $this->setCity($city);
                    $this->setProvince($province);
                    $this->setPostalCode($postalCode);
                    $this->setFirstName($userName);
                    $this->setFirstName($password);
                    $this->setFirstName($picture);
                }

        }

        public function createCustomer() {
            
            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pFirstName = $this->getFirstName();
            $pLastName = $this->getLastName();
            $pAddress = $this->getAddress();
            $pCity = $this->getCity();
            $pProvince = $this->getProvince();
            $pPostalCode = $this->getPostalCode();
            $pUserName = $this->getUserName();
            $pPassword = $this->getPassword();
            $pPicture = $this->getPicture();

            #stored procedure for insert new customer
            $create = 'Call insert_customer(?,?,?,?,?,?,?,?,?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($create);

            #bind the parameter
            $PDOobject->bindParam(1, $pFirstName, PDO::PARAM_STR);
            $PDOobject->bindParam(2, $pLastName, PDO::PARAM_STR);
            $PDOobject->bindParam(3, $pAddress, PDO::PARAM_STR);
            $PDOobject->bindParam(4, $pCity, PDO::PARAM_STR);
            $PDOobject->bindParam(5, $pProvince, PDO::PARAM_STR);
            $PDOobject->bindParam(6, $pPostalCode, PDO::PARAM_STR);
            $PDOobject->bindParam(7, $pUserName, PDO::PARAM_STR);
            $PDOobject->bindParam(8, $pPassword, PDO::PARAM_STR);
            $PDOobject->bindParam(9, $pPicture, PDO::PARAM_LOB);
            
            $PDOobject->execute();

            return "Account Created";
        }

        public function updateCustomer() {
            #setting up the connection
            global $connection;

        }

        public function getCustomerById(){
            #setting up the connection
            global $connection;
        }

        public function login(){
            #setting up the connection
            global $connection;
        }



        // // public function selectCustomerByID() {
            
        // //     global connection;
        // //     $customerById = 'Call select_one_customer(?)';

        // //     $PDOobject = $connection->prepare($customerById);

        // //     $PDOobject->bindParam(1, this.getCustomerId);

        // //     if($row = $PDOobject->fetch(PDO::FETCH_ASSOC)){
        // //         $this->setCustomerId = $row["customerId"];
        // //         $this->setFirstName = $row["fistName"];
        // //         $this->setLastName = $row["lastName"];
        // //         $this->setAddress = $row["address"];
        // //         $this->setCity = $row["city"];
        // //         $this->setProvince = $row["province"];
        // //         $this->setPostalCode = $row["postalCode"];
        // //         $this->setUserName = $row["userName"];
        // //         $this->setPassword = $row["password"];
        // //         $this->setPicture = $row["picture"];
        // //         return true;
        // //     }
        // // }


    }


?>