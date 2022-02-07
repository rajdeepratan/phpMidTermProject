<?php

# define all the contacts
define("FILE_INDEX", "index.php");
define("FILE_PRODUCTS", "products.php");
define("FILE_CONTACT", "contacts.php");

define("FOLDER_CSS", "./CSS/");
define("FILE_CSS", FOLDER_CSS . "style.css");
define("FOLDER_PICTURES", "assets/images/");
define("WEBSITE_LOGO", FOLDER_PICTURES . "logo.png");
define("FILE_IMAGE1", FOLDER_PICTURES . "select2.JPG");
define("FILE_IMAGE2", FOLDER_PICTURES . "select3.JPG");

function pageTop($pageTitle) {
    ?>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            
            <link rel="stylesheet" href="<?php echo FILE_CSS ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <title><?php echo $pageTitle; ?></title>
        </head>
        <body>
    <?php
    navigationMenu();
}

function navigationMenu() {
    ?>  
        <div class="nav-bar">
            <div class="logo-section">
                <img class="logo" src="<?php echo WEBSITE_LOGO ?>" alt="website-logo"/>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo FILE_INDEX ?>">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="<?php echo FILE_PRODUCTS ?>">Products</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="<?php echo FILE_CONTACT ?>">Contact Us</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </div>
    <?php
}

function pageBottom() {
    ?>
                <footer>
                    <h3 class="copy-right">Copyright Rajdeep Singh Ratan (2110167) 2022</h3>
                </footer>
            </body>
        </html>
    <?php
}


