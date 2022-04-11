<?php

    require_once "./class/collection.php";
    require_once "./class/product/product.php";
    require_once "./class/product/products.php";

    include_once "./phpFunction/functionProducts.php";

    $productsList = new products();

    #variables
    $productCode = "";
    $comment = "";
    $quantity = "";

    #error variables
    $errorOccurred = false;
    $errorProductCode = "";
    $errorComment = "";
    $errorQuantity = "";

    #success variable
    $success = false;

    #check if the user clicked the submit button
    if(isset($_POST["submitButton"])) {

        #variable Validation and save the POSTed data into a variable
        var_dump($_POST["productCode"]);
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

        if(mb_strlen($_POST["comment"]) > 0){
            if (mb_strlen($_POST["comment"]) > 200) {
                $errorOccurred = true;
                $errorComment = "Comment can not be more than 200 characters";
            } else {
                $comment = htmlspecialchars($_POST["comment"]);
            }
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
            // $data = array($productCode, $firstName, $lastName, $city, $comment, $price, $quantity, $subTotal, $taxesAmount, $roundedTotal);
            $JSONdata = json_encode($data);
            file_put_contents(DATA_FILE, "$JSONdata\r\n", FILE_APPEND);

            # clear all the variables
            $productCode = "";
            $comment = "";
            $quantity = 0;

            #show success message
            // echo "<meta http-equiv='refresh'content='0'>";
            $success = true;
        }

    }

    pageTop("Products");
?>

    <div class="product-page pt-5 pb-5">
        <form action="products.php" method="POST">
            <div class="mb-3">
                <label for="productCode" class="form-label">Product Code:</label>
                <select class="form-select" aria-label="product details" name="productCode" id="productCode">
                    <option value="" disabled selected hidden>Select the product</option>
                    <?php
                        foreach($productsList->items as $product) {
                            echo "<option value=".$product->getProductId().">".$product->getProductCode()." - ".$product->getProductDescription()." (".$product->getProductRetailPrice(). "$)</option>";
                        }
                    ?>
                </select>
                <div class="alert alert-danger mt-3 <?php if(empty($errorProductCode)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorProductCode;
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
