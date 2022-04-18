<?php
    include_once "./phpFunction/functionProducts.php";
    
    pageTop("Orders");

    require_once "./class/collection.php";
    require_once "./class/order/searchOrder.php";
    require_once "./class/order/searchOrders.php";


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
        $orderList = new searchOrders();
    }
    
?>

    <div class="order-page pt-5 pb-5">

        <form action="orders.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <label for="date" class="form-label">Search By Date:</label>
                    <input type="date" class="form-control" name="date" id="date" value="" />
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-end search-button">
                        <input type="submit" class="btn btn-primary" name="dateSearch" value="Search" />
                    </div>
                </div>
            </div>
        </form>

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
                <?php 
                    foreach($orderList->items as $searchOrder) {
                        echo "<tr>";
                        echo "<th scope='row'>delete</th>";
                        $date = date_create($searchOrder->getCreatedAt());
                        echo "<td>".date_format($date, 'Y-m-d')."</td>";
                        echo "<td>".$searchOrder->getProductCode()."</td>";
                        echo "<td>".$searchOrder->getFirstName()."</td>";
                        echo "<td>".$searchOrder->getLastName()."</td>";
                        echo "<td>".$searchOrder->getCity()."</td>";
                        echo "<td>".$searchOrder->getComments()."</td>";
                        echo "<td>".$searchOrder->getPrice()."</td>";
                        echo "<td>".$searchOrder->getProductQty()."</td>";
                        echo "<td>".$searchOrder->getPrice()*$searchOrder->getProductQty()."</td>";
                        echo "<td>".$searchOrder->getTaxesAmount()."</td>";
                        echo "<td>".($searchOrder->getPrice()*$searchOrder->getProductQty()) + $searchOrder->getTaxesAmount()."</td>";
                    }
                ?>
            </tbody>
        </table>

        <div class="cheat-sheet-download mt-5">
            <div class="alert alert-warning" role="alert">
                <b>Download Cheat Sheet:</b>
                <a href="<?php echo CHEAT_SHEET ?>">
                    Click Here!
                </a>
            </div>
        </div>
    </div>

<?php

    pageBottom();
?>
