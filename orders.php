<?php

    include_once "./phpFunction/functionProducts.php";
    pageTop("Orders");
    
?>

    <div class="order-page pt-5 pb-5">

        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Product Id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">City</th>
                <th scope="col">Comment</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Taxes</th>
                <th scope="col">Grand Total</th>
                </tr>
            </thead>
            <tbody>
                <?php showTableData(); ?>
            </tbody>
        </table>

    </div>

<?php

    pageBottom();
?>
