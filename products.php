
<?php

include_once "./phpFunction/functionProducts.php";
pageTop("Products");
?>

<br>we sell:
<br>computers
<br>cell phones


<?php

$products = array("Computers", "Cell phones", "Printers", "Mouse");

echo "<ul>";


for($index=0; $index < count($products); $index++) {
    echo "<li>". $products[$index] ."</li>";
}

echo "</ul>";

createComboBoxFunction($products);

function createComboBoxFunction($array) {
    #open the comboBox tag
    echo "<select>";

    #loop in the array
    for($index=0; $index < count($array); $index++) {
        echo "<option>". $array[$index] ."</option>";
    }

    echo "</select>";
#open the comboBox tag
}

pageBottom();
?>
