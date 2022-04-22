<?php 
    
    include_once "./phpFunction/functionProducts.php";
    session_start();

    require_once "./class/collection.php";
    require_once "./class/order/searchOrder.php";
    require_once "./class/order/searchOrders.php";

    header('Content-Type: text/plain');
    
    $todayDate = date("y-m-d h:i:s");
    $pCreatedAt = "";
    
    if(!empty($_POST["date"])){
        $d=strtotime($_POST["date"]);
        $pCreatedAt = date("y-m-d h:i:s", $d);
        if($pCreatedAt >  $todayDate) {
            $pCreatedAt = $todayDate;
        }
    }

    if(empty($_POST["date"])){
        $pCreatedAt = $todayDate;
    }

    $orderList = new searchOrders($pCreatedAt);

    foreach($orderList->items as $searchOrder) {
        echo "<tr>";
        echo "<th scope='row'><button type='submit' class='btn btn-danger' name='deleteItem' value=".$searchOrder->getOrderId().">Delete</button></th>";
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
        echo "</tr>";
    }
?>