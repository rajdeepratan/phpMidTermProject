<?php
    include_once "./phpFunction/functionProducts.php";

    pageTop("Index");

    #variables
    $firstName = "";
    $lastName = "";
    $address = "";
    $city = "";
    $province = "";
    $postalCode = "";
    $userName = "";
    $password = "";
    $profilePicture = "";

    #error variables
    $errorOccurred = false;
    $errorFirstName = "";
    $errorLastName = "";
    $errorAddress = "";
    $errorCity = "";
    $errorProvince = "";
    $errorPostalCode = "";
    $errorUserName = "";
    $errorPassword = "";
    $errorProfilePicture = "";

    #success variable
    $success = false;

    #check if the user clicked the submit button
    if(isset($_POST["submitButton"])) {

        #variable validation and save the POSTed data into a variables
        if(empty($_POST["firstName"])) {
            $errorOccurred = true;
            $errorFirstName = "Please enter your first name";
        } else if(mb_strlen($_POST["firstName"]) > 20) {
            $errorOccurred = true;
            $errorFirstName = "First name can not be more than 20 characters";
        } else {
            $firstName = htmlspecialchars($_POST["firstName"]);
        }

        if(empty($_POST["lastName"])) {
            $errorOccurred = true;
            $errorLastName = "Please enter your last name";
        } else if(mb_strlen($_POST["lastName"]) > 20) {
            $errorOccurred = true;
            $errorLastName = "Last name can not be more than 20 characters";
        } else {
            $lastName = htmlspecialchars($_POST["lastName"]);
        }

        if(empty($_POST["address"])) {
            $errorOccurred = true;
            $errorAddress = "Please enter your address";
        } else if(mb_strlen($_POST["address"]) > 25) {
            $errorOccurred = true;
            $errorAddress = "Address can not be more than 25 characters";
        } else {
            $address = htmlspecialchars($_POST["address"]);
        }

        if(empty($_POST["city"])) {
            $errorOccurred = true;
            $errorCity = "Please enter your city name";
        } else if(mb_strlen($_POST["city"]) > 25) {
            $errorOccurred = true;
            $errorCity = "City name can not be more than 25 characters";
        } else {
            $city = htmlspecialchars($_POST["city"]);
        }

        if(empty($_POST["province"])) {
            $errorOccurred = true;
            $errorProvince = "Please enter your province name";
        } else if(mb_strlen($_POST["province"]) > 25) {
            $errorOccurred = true;
            $errorProvince = "Province name can not be more than 25 characters";
        } else {
            $province = htmlspecialchars($_POST["province"]);
        }

        if(empty($_POST["postalCode"])) {
            $errorOccurred = true;
            $errorPostalCode = "Please enter your postal code";
        } else if(mb_strlen($_POST["postalCode"]) > 7) {
            $errorOccurred = true;
            $errorPostalCode = "Postal code can not be more than 7 characters";
        } else {
            $postalCode = htmlspecialchars($_POST["postalCode"]);
        }

        if(empty($_POST["userName"])) {
            $errorOccurred = true;
            $errorUserName = "Please enter your postal code";
        } else if(mb_strlen($_POST["userName"]) > 15) {
            $errorOccurred = true;
            $errorUserName = "User name can not be more than 15 characters";
        } else {
            $userName = htmlspecialchars($_POST["userName"]);
        }

        if(empty($_POST["password"])) {
            $errorOccurred = true;
            $errorPassword = "Please enter your postal code";
        } else if(mb_strlen($_POST["password"]) > 255) {
            $errorOccurred = true;
            $errorPassword = "Password can not be more than 255 characters";
        } else {
            $password = htmlspecialchars($_POST["password"]);
        }

        // echo empty($_FILES["profilePicture"]);
        if(empty($_FILES["profilePicture"])) {
            $errorOccurred = true;
            $errorProfilePicture = "Please upload your picture";
        } else if ((($_FILES["profilePicture"]["type"] == "image/gif") || ($_FILES["profilePicture"]["type"] == "image/jpeg") || ($_FILES["profilePicture"]["type"] == "image/png")  || ($_FILES["profilePicture"]["type"] == "image/pjpeg")) && ($_FILES["profilePicture"]["size"] < 16000000)) {
            // $profilePicture = 
        } else {
            $errorOccurred = true;
            $errorProfilePicture = "Only upload image file with gif, jpeg, png or pjpeg type.";
        }
        // else if(mb_strlen($_POST["password"]) > 255) {
        //     $errorOccurred = true;
        //     $errorProfilePicture = "Password can not be more than 255 characters";
        // } else {
        //     $profilePicture = htmlspecialchars($_POST["password"]);
        // }

    }

?>

    <div class="register-page pt-5 pb-5">
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstName" id="firstName" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorFirstName)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorFirstName;
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastName" id="lastName" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorLastName)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorLastName;
                        ?>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address" />
                <div class="alert alert-danger mt-3 <?php if(empty($errorAddress)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorAddress;
                        ?>
                    </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" id="city" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorCity)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorCity;
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="province" class="form-label">Province</label>
                    <input type="text" class="form-control" name="province" id="province" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorProvince)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorProvince;
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="postalCode" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" name="postalCode" id="postalCode" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorPostalCode)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorPostalCode;
                        ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="userName" class="form-label">User Name</label>
                    <input type="text" class="form-control" name="userName" id="userName" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorUserName)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorUserName;
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" id="password" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorPassword)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorPassword;
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="profilePicture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" name="profilePicture" id="profilePicture" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorProfilePicture)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorProfilePicture;
                        ?>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" name="submitButton" value="Register" />
            </div>
        </form>
    </div>


<?php
    pageBottom();
?>
