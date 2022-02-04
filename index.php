<?php
    include_once "./phpFunction/functionProducts.php";

    pageTop("Index");
?>



<?php
    $myarray = array(FILE_IMAGE,FILE_IMAGE1,FILE_IMAGE2);
    shuffle($myarray);
?>

    <img src="<?php echo $myarray[0]; ?>" class ="advertising" alt="advertising">


<?php

    pageBottom();
?>
