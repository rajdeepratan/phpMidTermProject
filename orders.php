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
                <th scope="col" class="text-end">Price</th>
                <th scope="col" class="text-end">Quantity</th>
                <th scope="col" class="text-end">Subtotal</th>
                <th scope="col" class="text-end">Taxes</th>
                <th scope="col" class="text-end">Grand Total</th>
                </tr>
            </thead>
            <tbody>
                <?php showTableData(); ?>
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
