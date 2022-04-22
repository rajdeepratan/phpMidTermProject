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
