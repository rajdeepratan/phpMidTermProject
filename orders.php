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
    require_once "./class/order/order.php";
    
    pageTop("Orders");

    if(empty($_SESSION['customerId'])) {
        header("Location:".FILE_LOGIN);
        exit;
        if(!headers_sent()){
            header("Location:".FILE_LOGIN);
            exit;
        } 
        else {
            echo "<script type='text/javascript'> location.href='".FILE_LOGIN."'; </script>";
        } 
    } else {
        
    }

    $order = new order();

    $errorOrderId = "";

    #check if the user clicked the delete item button
    if(isset($_POST['deleteItem'])) {
        $errorOrderId = $order->setOrderId($_POST["deleteItem"]);

        if(empty($errorOrderId)){
            $success = $order->deleteOrderById();
        }
    }
    
?>

    <div class="order-page pt-5 pb-5">

        <!-- <form action="orders.php" method="POST"> -->
            <div class="row">
                <div class="col-md-6">
                    <label for="date" class="form-label">Search By Date:</label>
                    <input type="date" class="form-control" name="date" id="date" value="" />
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-end search-button">
                        <input type="submit" class="btn btn-primary" name="dateSearch" value="Search" onClick="searchOrders()" />
                    </div>
                </div>
            </div>
        <!-- </form> -->

        <form method='post'>
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                    <th scope="col">Delete</th>
                    <th scope="col">Date</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">City</th>
                    <th scope="col">Comment</th>
                    <th scope="col" class="text-end">Price</th>
                    <th scope="col" class="text-end">Qty</th>
                    <th scope="col" class="text-end">Subtotal</th>
                    <th scope="col" class="text-end">Taxes</th>
                    <th scope="col" class="text-end">Total Amount</th>
                    </tr>
                </thead>
                <tbody id="order-table">
                </tbody>
            </table>
        </form>

        <div class="alert alert-success mt-4 text-center <?php if(!$success) echo "d-none" ?>" role="alert">
            <?php echo $success; ?>
        </div>
    </div>

<?php

    pageBottom();
?>
