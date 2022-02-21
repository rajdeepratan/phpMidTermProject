<?php

    include_once "./phpFunction/functionProducts.php";
    pageTop("Orders");

    #echo $_POST['command'];
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
                <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                </tr> -->
            </tbody>
        </table>

    </div>

<?php

    pageBottom();
?>
