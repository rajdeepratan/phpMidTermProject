<?php

    include_once "./phpFunction/functionProducts.php";

    #variables
    $productCode = "";
    $firstName = "";
    $lastName = "";
    $city = "";
    $comment = "";
    $price = "";
    $quantity = "";

    #error variables
    $errorOccurred = false;
    $errorProductCode = "";
    $errorFirstName = "";
    $errorLastName = "";
    $errorCity = "";
    $errorComment = "";
    $errorPrice = "";
    $errorQuantity = "";

    #success variable
    $success = false;

#validate the posted date

    #check if the user clicked the submit button
    if(isset($_POST["submitButton"])) {

        #variable Validation and save the POSTed data into a variable
        if(empty($_POST["productCode"])) {
            $errorOccurred = true;
            $errorProductCode = "Please enter the product code";
        } else if(mb_strlen($_POST["productCode"]) > 12) {
            $errorOccurred = true;
            $errorProductCode = "Product code not be more than 12 characters";
        } 
        else if(mb_substr($_POST["productCode"], 0,1) != 'p' && mb_substr($_POST["productCode"], 0,1) != 'P') {
            $errorOccurred = true;
            $errorProductCode = "Product code should start from P";
        } 
        else {
            $productCode = htmlspecialchars($_POST["productCode"]);
        }

        if(empty($_POST["firstName"])) {
            $errorOccurred = true;
            $errorFirstName = "Please enter the first name";
        } else if (mb_strlen($_POST["firstName"]) > 20) {
            $errorOccurred = true;
            $errorFirstName = "First name can not be more than 20 characters";
        } else {
            $firstName = htmlspecialchars($_POST["firstName"]);
        }

        if(empty($_POST["lastName"])) {
            $errorOccurred = true;
            $errorLastName = "Please enter the last name";
        } else if (mb_strlen($_POST["lastName"]) > 20) {
            $errorOccurred = true;
            $errorLastName = "Last name can not be more than 20 characters";
        } else {
            $lastName = htmlspecialchars($_POST["lastName"]);
        }

        if(empty($_POST["city"])) {
            $errorOccurred = true;
            $errorCity = "Please enter city name";
        } else if (mb_strlen($_POST["city"]) > 8) {
            $errorOccurred = true;
            $errorCity = "City name can not be more than 8 characters";
        } else {
            $city = htmlspecialchars($_POST["city"]);
        }

        if(mb_strlen($_POST["comment"]) > 0){
            if (mb_strlen($_POST["comment"]) > 200) {
                $errorOccurred = true;
                $errorComment = "Comment can not be more than 200 characters";
            } else {
                $comment = htmlspecialchars($_POST["comment"]);
            }
        }

        if(empty($_POST["price"])) {
            $errorOccurred = true;
            $errorPrice = "Please enter the price";
        } else if (is_numeric($_POST["price"]) || is_float($_POST["price"])) {
            $floatPrice = (float) $_POST["price"];
            if($floatPrice > 10000) {
                $errorOccurred = true;
                $errorPrice = "Price can not be higher than 10,000.00$";

            } else {
                $price = htmlspecialchars($_POST["price"]);
            }
        } 
        else {
            $errorOccurred = true;
            $errorPrice = "Price can not be higher than 10,000.00$";

        }
        
        if(empty($_POST["quantity"])) {
            $errorOccurred = true;
            $errorQuantity = "Please enter the quantity";
        } else if ($_POST["quantity"] < 1 && $_POST["quantity"] > 99) {
            $errorOccurred = true;
            $errorQuantity = "Quantity should be between 1 to 99";
        } else {
            $quantity = htmlspecialchars($_POST["quantity"]);
        }

        if($errorOccurred == false) {

            #calculate the sub total, taxes amount and grand total
            $subTotal = (float)$price * (float)$quantity;
            $taxesAmount = ($subTotal/100) * LOCAL_TAXES;
            $grandTotal = $subTotal + $taxesAmount;
            $roundedTotal = round($grandTotal, 2);

            #save all the values in file
            $data = array($productCode, $firstName, $lastName, $city, $comment, $price, $quantity, $subTotal, $taxesAmount, $roundedTotal);
            $JSONdata = json_encode($data);
            file_put_contents(DATA_FILE, "$JSONdata\r\n", FILE_APPEND);

            # clear all the variables
            $productCode = "";
            $firstName = "";
            $lastName = "";
            $city = "";
            $comment = "";
            $price = 0;
            $quantity = 0;

            #show success message
            // echo "<meta http-equiv='refresh'content='0'>";
            $success = true;
        }

    }
?>



<?php
    pageTop("Products");
?>

    <div class="product-page pt-5 pb-5">
        <form action="products.php" method="POST">
            <div class="mb-3">
                <label for="productCode" class="form-label">Product Code:</label>
                <input type="text" class="form-control" name="productCode" id="productCode" value="<?php echo $productCode ?>" />
                <div class="alert alert-danger mt-3 <?php if(empty($errorProductCode)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorProductCode;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $firstName ?>" />
                <div class="alert alert-danger mt-3 <?php if(empty($errorFirstName)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorFirstName;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $lastName ?>" />
                <div class="alert alert-danger mt-3 <?php if(empty($errorLastName)) echo "d-none" ?>" role="alert">
                   <?php 
                        echo $errorLastName;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" name="city" id="city" value="<?php echo $city ?>" />
                <div class="alert alert-danger mt-3 <?php if(empty($errorCity)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorCity;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment:</label>
                <textarea class="form-control" name="comment" id="comment" rows="5"><?php echo $comment ?></textarea>

                <div class="alert alert-danger mt-3 <?php if(empty($errorComment)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorComment;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" class="form-control" name="price" id="price" value="<?php echo $price ?>"/>
                <div class="alert alert-danger mt-3 <?php if(empty($errorPrice)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorPrice;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity ?>" />
                <div class="alert alert-danger mt-3 <?php if(empty($errorQuantity)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorQuantity;
                    ?>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" name="submitButton" value="Submit" />
        </form>
        <div class="alert alert-success mt-4 <?php if(!$success) echo "d-none" ?>" role="alert">
            Your order has been placed
        </div>

    </div>

<?php
    pageBottom();
?>
