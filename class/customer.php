<?php 

require_once('../phpFunction/connection.php')

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
    private $picture = "";

    public function getCustomerId() {
        return $this->customerId;
    }
    protected function setCustomerId($firstName) {
        $this->customerId = $customerId;
        return null;
    }

    public function getFirstName() {
        return $this->firstName;
    }
    public function setFirstName($firstName) {
        if(mb_strlen($firstName) === 0) {
            return "The first name is empty";
        } else if(mb_strlen($firstName) > self::NAME_MAX_LENGTH) {
            return "This first name is greater than 20 char";
        } else {
            $this->firstName = $firstName;
            return null;
        }
    }

    public function getLastName() {
        return $this->lastName;
    }
    public function setLastName($lastName) {
        if(mb_strlen($lastName) === 0) {
            return "The last name is empty";
        } else if(mb_strlen($lastName) > self::NAME_MAX_LENGTH) {
            return "This last name is greater than 20 char";
        } else {
            $this->lastName = $lastName;
            return null;
        }
    }

    public function getAddress() {
        return $this->address;
    }
    public function setAddress($address) {
        if(mb_strlen($address) === 0) {
            return "The address is empty";
        } else if(mb_strlen($address) > self::ADDRESS_MAX_LENGTH) {
            return "This address is greater than 25 char";
        } else {
            $this->address = $address;
            return null;
        }
    }

    public function getCity() {
        return $this->city;
    }
    public function setCity($city) {
       if(mb_strlen($city) === 0) {
            return "The city is empty";
        } else if(mb_strlen($city) > self::ADDRESS_MAX_LENGTH) {
            return "This city is greater than 25 char";
        } else {
            $this->city = $city;
            return null;
        }
    }

    public function getProvince() {
        return $this->province;
    }
    public function setProvince($province) {
        if(mb_strlen($province) === 0) {
            return "The province is empty";
        } else if(mb_strlen($province) > self::ADDRESS_MAX_LENGTH) {
            return "This province is greater than 25 char";
        } else {
            $this->province = $province;
            return null;
        }
    }
    
    public function getPostalCode() {
        return $this->postalCode;
    }
    public function setPostalCode($postalCode) {
        if(mb_strlen($postalCode) === 0) {
            return "The postalCode is empty";
        } else if(mb_strlen($postalCode) > self::POSTAL_MAX_LENGTH) {
            return "This postalCode is greater than 7 char";
        } else {
            $this->postalCode = $postalCode;
            return null;
        }
    }

    public function getUserName() {
        return $this->userName;
    }
    public function setUserName($userName) {
        if(mb_strlen($userName) === 0) {
            return "The userName is empty";
        } else if(mb_strlen($userName) > self::USERNAME_MAX_LENGTH) {
            return "This userName is greater than 15 char";
        } else {
            $this->userName = $userName;
            return null;
        }
    }
    
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        if(mb_strlen($password) === 0) {
            return "The password is empty";
        } else if(mb_strlen($password) > self::PASSWORD_MAX_LENGTH) {
            return "This password is greater than 255 char";
        } else {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
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
                $this->$picture = file_get_contents($_FILES[$profilePicture]["tmp_name"]);
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

    public function __construct($firstName, $lastName, $address, $city, $province, $postalCode, $userName, $password, $picture) {
        
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

    public function save() {
        
        global connection;
        $save = 'Call insert_customer(?,?,?,?,?,?,?,?,?)';

        $PDOobject = $connection->prepare($save);

        $PDOobject->bindParam(1, $this.getFirstName);
        $PDOobject->bindParam(2, $this.getLastName);
        $PDOobject->bindParam(3, $this.getAddress);
        $PDOobject->bindParam(4, $this.getCity);
        $PDOobject->bindParam(5, $this.getProvince);
        $PDOobject->bindParam(6, $this.getPostalCode);
        $PDOobject->bindParam(7, $this.getUserName);
        $PDOobject->bindParam(8, $this.getPassword);
        $PDOobject->bindParam(9, $this.getPicture);

    }

    public function selectCustomerByID() {
        
        global connection;
        $customerById = 'Call select_one_customer(?)';

        $PDOobject = $connection->prepare($customerById);

        $PDOobject->bindParam(1, this.getCustomerId);

        if($row = $PDOobject->fetch(PDO::FETCH_ASSOC)){
            $this->setCustomerId = $row["customerId"];
            $this->setFirstName = $row["fistName"];
            $this->setLastName = $row["lastName"];
            $this->setAddress = $row["address"];
            $this->setCity = $row["city"];
            $this->setProvince = $row["province"];
            $this->setPostalCode = $row["postalCode"];
            $this->setUserName = $row["userName"];
            $this->setPassword = $row["password"];
            $this->setPicture = $row["picture"];
            return true;
        }
    }


}


?>