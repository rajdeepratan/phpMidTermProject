<?php 

    require_once "connection/connection.php";

    class customer {

        const NAME_MAX_LENGTH = 20;
        const ADDRESS_MAX_LENGTH = 25;
        const POSTAL_MAX_LENGTH = 8;
        const USERNAME_MAX_LENGTH = 15;
        const PASSWORD_MAX_LENGTH = 255;
        
        private $customerId = "";
        private $firstName = "";
        private $lastName = "";
        private $address = "";
        private $city = "";
        private $province = "";
        private $postalCode = "";
        private $username = "";
        private $password = "";
        private $picture;

        public function getCustomerId() {
            return $this->customerId;
        }
        public function setCustomerId($customerId) {
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
                return "First name is greater than 20 char";
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
                return "Last name is greater than 20 char";
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
                return "Address is greater than 25 char";
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
                return "City is greater than 25 char";
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
                return "Province is greater than 25 char";
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
                return "Postal code is greater than 7 char";
            } else {
                $this->postalCode = htmlspecialchars($postalCode);
                return null;
            }
        }

        public function getUsername() {
            return $this->username;
        }
        public function setUsername($username) {
            if(empty($username)) {
                return "The user name is empty";
            } else if(mb_strlen($username) > self::USERNAME_MAX_LENGTH) {
                return "Username can not be greater than 15 char";
            } else {
                $this->username = htmlspecialchars($username);
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
                return "Password can not greater than 255 char";
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

        public function __construct($customerId = "", $firstName = "", $lastName = "", $address = "", $city = "", $province = "", $postalCode = "", $username = "", $password = "", $picture = "") {

                if($customerId) {
                    $this->setCustomerId($customerId);
                }
                if($firstName){
                    $this->setFirstName($firstName);
                }
                if($lastName){
                    $this->setLastName($lastName);
                }
                if($address){
                    $this->setAddress($address);
                }
                if($city) {
                    $this->setCity($city);
                }
                if($province){
                    $this->setProvince($province);
                }
                if($postalCode){
                    $this->setPostalCode($postalCode);
                }
                if($username){
                    $this->setUsername($username);
                }
                if($password){
                    $this->setPassword($password);
                }
                if($picture){
                    $this->setPicture($picture);
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
            $pUsername = $this->getUsername();
            $pPassword = $this->getPassword();
            $pPicture = $this->getPicture();

            #stored procedure for insert new customer
            $createCustomer = 'Call insertCustomer(?,?,?,?,?,?,?,?,?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($createCustomer);

            #bind the parameter
            $PDOobject->bindParam(1, $pFirstName, PDO::PARAM_STR);
            $PDOobject->bindParam(2, $pLastName, PDO::PARAM_STR);
            $PDOobject->bindParam(3, $pAddress, PDO::PARAM_STR);
            $PDOobject->bindParam(4, $pCity, PDO::PARAM_STR);
            $PDOobject->bindParam(5, $pProvince, PDO::PARAM_STR);
            $PDOobject->bindParam(6, $pPostalCode, PDO::PARAM_STR);
            $PDOobject->bindParam(7, $pUsername, PDO::PARAM_STR);
            $PDOobject->bindParam(8, $pPassword, PDO::PARAM_STR);
            $PDOobject->bindParam(9, $pPicture, PDO::PARAM_LOB);
            
            $PDOobject->execute();

            return "Account Created, Go back and sign in";

        }

        public function getCustomerById(){

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pCustomerId = $this->getCustomerById();

            #stored procedure for get customer by id
            $getCustomer = 'Call selectOneCustomer(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($getCustomer);

            #bind the parameter
            $PDOobject->bindParam(1, $pCustomerId, PDO::PARAM_STR);

            $PDOobject->execute();
            while($row = $PDOobject->fetch()) {
                $this->setCustomerId($row['customerId']);
                $this->setFirstName($row['firstName']);
                $this->setLastName($row['lastName']);
                $this->setAddress($row['address']);
                $this->setCity($row['city']);
                $this->setProvince($row['province']);
                $this->setPostalCode($row['postalCode']);
                $this->setUsername($row['username']);
                // $this->setPassword($row['password']);
                $this->setPicture($row['picture']);
            }
        }

        public function updateCustomerById() {

            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pCustomerId = $this->getCustomerId();
            $pFirstName = $this->getFirstName();
            $pLastName = $this->getLastName();
            $pAddress = $this->getAddress();
            $pCity = $this->getCity();
            $pProvince = $this->getProvince();
            $pPostalCode = $this->getPostalCode();
            $pUsername = $this->getUsername();
            $pPassword = $this->getPassword();
            $pPicture = $this->getPicture();

            #stored procedure for update customer by id
            $updateCustomer = 'Call updateCustomer(?,?,?,?,?,?,?,?,?,?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($updateCustomer);

            #bind the parameter
            $PDOobject->bindParam(1, $pCustomerId, PDO::PARAM_STR);
            $PDOobject->bindParam(2, $pFirstName, PDO::PARAM_STR);
            $PDOobject->bindParam(3, $pLastName, PDO::PARAM_STR);
            $PDOobject->bindParam(4, $pAddress, PDO::PARAM_STR);
            $PDOobject->bindParam(5, $pCity, PDO::PARAM_STR);
            $PDOobject->bindParam(6, $pProvince, PDO::PARAM_STR);
            $PDOobject->bindParam(7, $pPostalCode, PDO::PARAM_STR);
            $PDOobject->bindParam(8, $pUsername, PDO::PARAM_STR);
            $PDOobject->bindParam(9, $pPassword, PDO::PARAM_STR);
            $PDOobject->bindParam(10, $pPicture, PDO::PARAM_LOB);
            
            $PDOobject->execute();

            $_SESSION['firstName'] = $pFirstName;
            $_SESSION['lastName'] = $pLastName;
            $_SESSION['address'] = $pAddress;
            $_SESSION['city'] = $pCity;
            $_SESSION['province'] = $pProvince;
            $_SESSION['postalCode'] = $pPostalCode;
            $_SESSION['username'] = $pUsername;
            $_SESSION['picture'] = $pPicture;

            
            return "Account Updated, Refresh the page to see it's effect";

        }

        public function deleteCustomerById(){
            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pCustomerId = $this->getCustomerById();

            #stored procedure for delete customer by id
            $deleteCustomer = 'Call deleteCustomer(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($deleteCustomer);

            #bind the parameter
            $PDOobject->bindParam(1, $pCustomerId, PDO::PARAM_STR);

            $PDOobject->execute();

            return "Customer Deleted, Refresh the page to see it's effect";
        }

        public function login($pPassword){
            
            #setting up the connection
            global $connection;

            #store class variables inside function local variable
            $pUsername = $this->getUsername();

            #stored procedure for customer login
            $login = 'Call loginCustomer(?)';

            #execute the SQL statement
            $PDOobject = $connection->prepare($login);

            #bind the parameter
            $PDOobject->bindParam(1, $pUsername, PDO::PARAM_STR);

            $PDOobject->execute();

            while($row = $PDOobject->fetch()) {
                $passwordHash = $row['password'];
                $valid = password_verify($pPassword, $passwordHash);

                if($valid) {
                    $_SESSION['customerId'] = $row['customerId'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['city'] = $row['city'];
                    $_SESSION['province'] = $row['province'];
                    $_SESSION['postalCode'] = $row['postalCode'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['picture'] = $row['picture'];
                    
                    return "";
                } else {
                    return "Username or password is incorrect!";
                }
            }

        }


    }


?>