<?php

    require_once "./class/customer/customer.php";
    
    include_once "./phpFunction/functionProducts.php";

    pageTop("Index");

    #login customer ID
    $customerId="";

    #create customer class object
    if(isset($_SESSION['customerId']) && isset($_SESSION['firstName']) && isset($_SESSION['lastName']) && isset($_SESSION['address']) && isset($_SESSION['city']) && isset($_SESSION['province']) && isset($_SESSION['postalCode']) && isset($_SESSION['username'])) {
        $customer = new customer($_SESSION['customerId'], $_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['address'], $_SESSION['city'], $_SESSION['province'], $_SESSION['postalCode'], $_SESSION['username'], '', '');
        $customerId = $_SESSION['customerId'];
    } else {
        $customer = new customer();

    }

    #error variables
    $errorOccurred = false;
    $errorFirstName = "";
    $errorLastName = "";
    $errorAddress = "";
    $errorCity = "";
    $errorProvince = "";
    $errorPostalCode = "";
    $errorUsername = "";
    $errorPassword = "";
    $errorProfilePicture = "";

    #success variable
    $success = "";

    #check if the user clicked the submit button
    if(isset($_POST["submitButton"])) {
        

        #variable validation and save the POSTed data into a variables
        $errorFirstName = $customer->setFirstName($_POST["firstName"]);
        $errorLastName = $customer->setLastName($_POST["lastName"]);
        $errorAddress = $customer->setAddress($_POST["address"]);
        $errorCity = $customer->setCity($_POST["city"]);
        $errorProvince = $customer->setProvince($_POST["province"]);
        $errorPostalCode = $customer->setPostalCode($_POST["postalCode"]);
        $errorUsername = $customer->setUsername($_POST["username"]);
        $errorPassword = $customer->setPassword($_POST["password"]);
        $errorProfilePicture = $customer->setPicture("profilePicture");

        #error occurred
        if($errorFirstName || $errorLastName || $errorAddress || $errorCity || $errorProvince || $errorPostalCode || $errorUsername || $errorPassword || $errorProfilePicture) {
            $errorOccurred = true;
        }

        if($errorOccurred == false) {
            if(empty($customerId)) {
                $success = $customer->createCustomer();
            } else {
                $success = $customer->updateCustomer();
            }
        }
    
    }

?>

    <div class="register-page pt-5 pb-5">
        <form action='<?php echo $_SERVER["PHP_SELF"] ?>' method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $customer->getFirstName(); ?>" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorFirstName)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorFirstName;
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $customer->getLastName(); ?>" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorLastName)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorLastName;
                        ?>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="<?php echo $customer->getAddress(); ?>" />
                <div class="alert alert-danger mt-3 <?php if(empty($errorAddress)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorAddress;
                        ?>
                    </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" id="city" value="<?php echo $customer->getCity(); ?>" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorCity)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorCity;
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="province" class="form-label">Province</label>
                    <input type="text" class="form-control" name="province" id="province" value="<?php echo $customer->getProvince(); ?>" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorProvince)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorProvince;
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="postalCode" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" name="postalCode" id="postalCode" value="<?php echo $customer->getPostalCode(); ?>" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorPostalCode)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorPostalCode;
                        ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="username" class="form-label">User Name</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $customer->getUsername(); ?>" />
                    <div class="alert alert-danger mt-3 <?php if(empty($errorUsername)) echo "d-none" ?>" role="alert">
                        <?php 
                            echo $errorUsername;
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="<?php echo $customer->getPassword(); ?>" />
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
                <input type="submit" class="btn btn-primary" name="submitButton" value="<?php if(empty($customerId)){ echo "Register"; }else{ echo "Update"; } ?>" />
            </div>
            <div class="text-center alert alert-success mt-3 <?php if(empty($success)) echo "d-none" ?>" role="alert">
                <?php 
                    echo $success;
                ?>
            </div>
        </form>
    </div>


<?php
    pageBottom();
?>
