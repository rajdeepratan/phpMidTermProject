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
        <div class="alert alert-danger mt-3 <?php if(empty($errorCustomerID) && empty($errorPrice)) echo "d-none" ?>" role="alert">
            <?php 
                if(!empty($errorCustomerID)){
                    echo $errorCustomerID;
                } else {
                    echo $errorPrice;
                }
            ?>
        </div>
        <div class="alert alert-success mt-4 <?php if(!$success) echo "d-none" ?>" role="alert">
            <?php echo $success; ?>
        </div>

    </div>

<?php
    pageBottom();
?>
