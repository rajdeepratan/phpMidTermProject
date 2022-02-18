<?php

define("DEBUGGING_MODE", true);
define("FOLDER_ERROR", "./errors/");
define("FILE_ERROR", FOLDER_ERROR ."log.txt");
$currentDateTime = date('Y-m-d');
echo $currentDateTime;

function manageError($errorNumber, $errorString, $errorFile, $errorLine) {
    global $currentDateTime;
    
    $detailedError = $currentDateTime . " - An error " . $errorNumber . "{" . $errorString . "} occurred in the file " . $errorFile . " at line " . $errorLine;

    if(DEBUGGING_MODE == true) {
        #for developers
        echo $detailedError;
    }

    #for end-user
    echo "<br>An error occurred";


    #save in the file the detail error
    $data = $detailedError;
    $JSONdata = json_encode($detailedError);
    file_put_contents(FILE_ERROR, "$JSONdata\r\n", FILE_APPEND);

    exit(); # kill PHP
    
}

function manageException($exception) {

    $detailedError = "An exception " . $exception->getCode() . "{" . $exception->getMessage() . "} occurred in the file " . $exception->getFile() . " at line " . $exception->getLine();

    if(DEBUGGING_MODE == true) {
        #for developers
        echo $detailedError;
    }

    #for end-user
    echo "<br>An exception occurred";


    #save in the file the detail error
    $JSONdata = json_encode($detailedError);
    file_put_contents(FILE_ERROR, "$JSONdata\r\n", FILE_APPEND);

    exit(); # kill PHP
    
}

set_error_handler("manageError");
set_exception_handler("manageException");

# define all the contacts
define("LOCAL_TAXES", 13.45);
define("FILE_INDEX", "index.php");
define("FILE_PRODUCTS", "products.php");
define("FILE_ORDERS", "orders.php");

define("FOLDER_CSS", "./css/");
define("FILE_CSS", FOLDER_CSS . "style.css");

define("FOLDER_PICTURES", "./assets/images/");
define("WEBSITE_LOGO", FOLDER_PICTURES . "logo.png");
define("COLLOCATION1", FOLDER_PICTURES . "collocation-1.jpeg");
define("COLLOCATION2", FOLDER_PICTURES . "collocation-2.jpeg");
define("COLLOCATION3", FOLDER_PICTURES . "collocation-3.jpeg");
define("COLLOCATION4", FOLDER_PICTURES . "collocation-4.jpeg");
define("COLLOCATION5", FOLDER_PICTURES . "collocation-5.jpeg");
define("COLLOCATION6", FOLDER_PICTURES . "collocation-6.jpeg");
define("COLLOCATION7", FOLDER_PICTURES . "collocation-7.jpeg");
define("COLLOCATION8", FOLDER_PICTURES . "collocation-8.jpeg");
define("COLLOCATION9", FOLDER_PICTURES . "collocation-9.jpeg");

define("DATA_FOLDER", "./dataFile");
define("DATA_FILE", DATA_FOLDER . "data.txt");


function pageTop($pageTitle) {
    header('Expires: Sat, 03 Dec 1994 16:00:00 GMT');
    header('CacheControl: no-cache');
    header('Pragma: no-cache');
    header('Content-type: text/html; charset=UTF-8');
    ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            
            <link rel="stylesheet" href="<?php echo FILE_CSS ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

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
            <div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
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
                            <a class="nav-link" href="<?php echo FILE_ORDERS ?>">Orders</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container">
    <?php
}

function pageBottom() {
    ?>      </div>
                <footer class="">
                    <p class="copy-right">Copyright <span>Rajdeep Singh Ratan (2110167)</span> <?php echo date("Y"); ?></p>
                </footer>
            </body>
        </html>
        
    <?php
}


