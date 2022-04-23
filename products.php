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
    
    include_once "./phpFunction/functionProducts.php";

    pageTop("Products");

    require_once "./class/collection.php";
    require_once "./class/product/product.php";
    require_once "./class/product/products.php";

    require_once "./class/order/order.php";

    $productsList = new products();
    $order = new order();

    #error variables
    $errorOccurred = false;
    $errorCustomerID = "";
    $errorProductId = "";
    $errorProductQty = "";
    $errorPrice = "";
    $errorTaxesAmount = "";
    $errorComments = "";

    #success variable
    $success = "";


    #check if the user clicked the submit button
    if(isset($_POST["submitButton"])) {

        if(isset($_SESSION['customerId'])) {
            $errorCustomerID = $order->setCustomerId($_SESSION['customerId']);
        } else {
            $errorCustomerID = "Need to login before placing your order";
        }

        $errorProductId = $order->setProductId($_POST["productId"]);
        $errorComments = $order->setComments($_POST["comment"]);
        $errorProductQty = $order->setProductQty($_POST["quantity"]);
        foreach($productsList->items as $product) {
            if($product->getProductId() == $_POST["productId"]){
                $errorPrice = $order->setPrice($product->getProductRetailPrice());
            }
        }
        $subTotal = $order->getPrice() * $_POST["quantity"];
        $taxesAmount = ($subTotal/100) * LOCAL_TAXES;
        $errorTaxesAmount = $order->setTaxesAmount($taxesAmount);
        
        #error occurred
        if($errorCustomerID || $errorProductId || $errorProductQty || $errorPrice || $errorTaxesAmount || $errorComments) {
            $errorOccurred = true;
        }

        if($errorOccurred == false) {
            $success = $order->createOrder();
        }

    }
?>

    <div class="product-page pt-5 pb-5">
        <form action="products.php" method="POST">
            <div class="mb-3">
                <label for="productId" class="form-label">Product:</label>
                <select class="form-select" aria-label="product details" name="productId" id="productId">
                    <option value="" disabled selected hidden>Select the product</option>
                    <?php
                        foreach($productsList->items as $product) {
                            echo "<option value=".$product->getProductId().">".$product->getProductCode()." - ".$product->getProductDescription()." (".$product->getProductRetailPrice(). "$)</option>";
                        }
                    ?>
                </select>
                <div class="alert alert-danger mt-3 <?php if(empty($errorProductId)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorProductId;
                    ?>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="comment" class="form-label">Comment:</label>
                <textarea class="form-control" name="comment" id="comment" rows="5"></textarea>

                <div class="alert alert-danger mt-3 <?php if(empty($errorComments)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorComments;
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" name="quantity" id="quantity" value="" />
                <div class="alert alert-danger mt-3 <?php if(empty($errorProductQty)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorProductQty;
                    ?>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" name="submitButton" value="Submit" />
        </form>
        <div class="alert alert-danger text-center mt-3 <?php if(empty($errorCustomerID) && empty($errorPrice)) echo "d-none" ?>" role="alert">
            <?php 
                if(!empty($errorCustomerID)){
                    echo $errorCustomerID;
                } else {
                    echo $errorPrice;
                }
            ?>
        </div>
        <div class="alert alert-success text-center mt-4 <?php if(!$success) echo "d-none" ?>" role="alert">
            <?php echo $success; ?>
        </div>

    </div>

<?php
    pageBottom();
?>
