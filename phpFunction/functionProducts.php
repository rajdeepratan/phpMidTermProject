<?php

# define all the contacts
define("FILE_INDEX", "index.php");
define("FILE_PRODUCTS", "products.php");
define("FILE_CONTACT", "contacts.php");

define("FOLDER_CSS", "./CSS/");
define("FILE_CSS", FOLDER_CSS . "style.css");
define("FOLDER_PICTURES", "assets/images/");
define("WEBSITE_LOGO", FOLDER_PICTURES . "logo.jpeg");
define("FILE_IMAGE1", FOLDER_PICTURES . "select2.JPG");
define("FILE_IMAGE2", FOLDER_PICTURES . "select3.JPG");

function pageTop($pageTitle) {
    ?>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            
            <link rel="stylesheet" href="<?php echo FILE_CSS ?>"/>
            
            <title><?php echo $pageTitle; ?></title>
        </head>
        <body>
            <img src="<?php echo WEBSITE_LOGO ?>" alt="Image"  class="heightImage widthImage"/>

    <?php
    navigationMenu();
}

function navigationMenu() {
    ?>
        <a href="<?php echo FILE_INDEX ?>">Index</a>
        <a href="<?php echo FILE_PRODUCTS ?>">Products</a>
        <a href="<?php echo FILE_CONTACT ?>">Contact Us</a>
    <?php
}

function pageBottom() {
    ?>
        <footer>
            <h3 class="copy-right">Copyright Rajdeep Singh Ratan (2110167) 2022</h3>
        </footer>
        </body></html>
    <?php
}


