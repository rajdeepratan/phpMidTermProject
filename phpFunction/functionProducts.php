<?php

    include_once "../login.php";

define("DEBUGGING_MODE", TRUE);
define("FOLDER_ERROR", "./errors/");
define("FILE_ERROR", FOLDER_ERROR ."error.log");
$currentDateTime = date('Y-m-d h:m:s');
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

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
    global $currentDateTime;

    $detailedError = $currentDateTime . " - An exception " . $exception->getCode() . "{" . $exception->getMessage() . "} occurred in the file " . $exception->getFile() . " at line " . $exception->getLine();

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
define("FILE_REGISTER", "register.php");
define("FILE_LOGIN", "login.php");
define("FILE_LOGOUT", "logout.php");

define("FOLDER_CSS", "./css/");
define("FILE_CSS", FOLDER_CSS . "style.css");
define("BOOTSTRAP_CSS", FOLDER_CSS . "bootstrap.min.css");

define("FOLDER_JS", "./javascript/");
define("BOOTSTRAP_JS", FOLDER_JS . "bootstrap.min.js");

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

define("DATA_FOLDER", "./dataFile/");
define("DATA_FILE", DATA_FOLDER . "data.txt");
define("CHEAT_SHEET", DATA_FOLDER . "cheatSheet.docx");


// Page Top Section
function pageTop($pageTitle) {

    global $curPageName;

    header('Expires: Sat, 03 Dec 1994 16:00:00 GMT');
    header('CacheControl: no-cache');
    header('Pragma: no-cache');
    header('Content-type: text/html; charset=UTF-8');
    
    session_start();

    ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            
            <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Bootstrap CSS -->
            <link href="<?php echo BOOTSTRAP_CSS ?>" rel="stylesheet" type="text/css">

            <title><?php echo $pageTitle; ?></title>
        </head>
        <body>
            
    <?php
    navigationMenu();
}

// Page Menu
function navigationMenu() {
    global $curPageName;
    ?>  
        <div class="nav-bar">
            <div class="logo-section">
                <img 
                    class="logo
                        <?php 
                            if($curPageName === FILE_ORDERS && isset($_GET["command"])) {
                                if ($_GET["command"] == "print") {
                                    echo "print-screen";
                                }
                            }
                        ?>
                    "
                    src="<?php echo WEBSITE_LOGO ?>" alt="website-logo"
                />
            </div>
            <div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a 
                                        class="nav-link 
                                            <?php if($curPageName === FILE_INDEX)
                                                echo "active";
                                            ?>"
                                        aria-current="page" 
                                        href="<?php echo FILE_INDEX ?>"
                                    >
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a 
                                        class="nav-link 
                                            <?php if($curPageName === FILE_PRODUCTS)
                                                echo "active";
                                            ?>"
                                        href="<?php echo FILE_PRODUCTS ?>"
                                    >
                                        Products
                                    </a>
                                </li>
                                <?php if(!empty($_SESSION['customerId'])) { ?>
                                <li class="nav-item">
                                    <a
                                        class="nav-link 
                                            <?php if($curPageName === FILE_ORDERS)
                                                echo "active";
                                            ?>"
                                        href="<?php echo FILE_ORDERS ?>"
                                    >
                                        Orders
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php if(empty($_SESSION['customerId'])) { ?>
                                <a class="nav-link 
                                        <?php if($curPageName === FILE_LOGIN)
                                            echo "active";
                                        ?>"
                                    href="<?php echo FILE_LOGIN ?>"
                                >
                                    Sign In / Sign Up
                                </a>
                            <?php } else { ?>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php  echo  "<img class='profile-image' src='data:image/jpeg;base64,".base64_encode($_SESSION['picture'])."' /> " . $_SESSION['firstName'] .' '. $_SESSION['lastName']
                                        ?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="<?php echo FILE_REGISTER ?>">Profile</a></li>
                                        <li><a class="dropdown-item" href="<?php echo FILE_LOGOUT ?>">Sign Out</a></li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container">
    <?php
}

// Page Footer Section
function pageBottom() {
    ?>      </div>
                <footer class="">
                    <p class="copy-right">Copyright <span>Rajdeep Singh Ratan (2110167)</span> <?php echo date("Y"); ?></p>
                </footer>

                <!-- Option 1: Bootstrap Bundle with Popper -->
                <script type="text/javascript" src="<?php echo BOOTSTRAP_JS ?>"></script>
            </body>
        </html>
        
    <?php
}


// Order Page Show Table Data Section
function showTableData(){
    
    if(file_exists(DATA_FILE)){

        #open the file
        $fileHandle = fopen(DATA_FILE,"r");#use r for Reading
        
        #read from a file
        while(! feof($fileHandle)){

        #in the project: read the file, decode the JSON string,
        #use the array to fill the HTML table
        $fileLine = fgets($fileHandle); #read a line in the file and put it in variable
        
            if(($fileLine)!=""){
                $array = json_decode($fileLine);
                echo "<tr>";
                foreach ($array as $key => $value) {
                    if($key == 0) {
                        echo "<th scope='row'>".$value."</th>";
                    } else if ($key == 5 || $key == 7 || $key == 8 ||$key == 9) {
                        ?>
                        <td class="text-end 
                            <?php
                        if($key == 7 && isset($_GET["command"])) {
                            if ($_GET["command"] == "color") {
                                if($value < 100.00) {
                                    echo " red-text";
                                } else if ($value < 999.99) {
                                    echo " orange-text";
                                } else {
                                    echo " green-text";
                                }
                            }
                        }
                        ?>"><?php echo $value."$</td>";
                    } else if($key == 6) {
                        echo "<td class=text-end>".$value."</td>";
                    } else {
                        echo "<td>".$value."</td>";
                    }   

                }
                echo "</tr>";
            }
        }
        
        #close the file
        fclose($fileHandle);
    }
}