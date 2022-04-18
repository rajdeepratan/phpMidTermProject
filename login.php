<?php

    require_once "./class/customer/customer.php";

    include_once "./phpFunction/functionProducts.php";
    
    pageTop("Sign In");

    #error variables
    $errorOccurred = false;
    $errorUsername = "";
    $errorPassword = "";
    $errorLogin = "";

    if(isset($_POST["loginButton"])) {

        $customer = new customer();

        // $pPassword = $_POST["password"];

        $errorUsername = $customer->setUsername($_POST["username"]);
        // $errorPassword = $customer->setPassword($_POST["password"]);

        // if($errorUsername) {
        //     $errorOccurred = true;
        // }
        // if($errorPassword) {
        //     $errorOccurred = true;
        // }

        if($errorOccurred == false) {
            $errorLogin = $customer->login($_POST["password"]);
        }

        // if(!$errorLogin) {
        //     // echo $_SESSION['customerId'];
        //     header("Location:".FILE_REGISTER);
        //     exit;
        // }
    }

    if(!empty($_SESSION['customerId'])) {
        header("Location:".FILE_REGISTER);
        exit;
    }

   
?>

    <div class="login-page pt-5 pb-5">
        <h3 class="text-center">Sign In</h3>
        <div>
            <form class="px-4 py-3" action="login.php" method="POST">
                <div class="alert alert-danger mt-3 <?php if(empty($errorLogin)) echo "d-none" ?>" role="alert">
                    <?php 
                        echo $errorLogin;
                    ?>
                </div>
                <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                </div>
                <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                    <label class="form-check-label" for="dropdownCheck">
                    Remember me
                    </label>
                </div>
                </div>
                <input type="submit" class="btn btn-primary" name="loginButton" value="Sign in" />
            </form>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo FILE_REGISTER ?>">New around here? Sign up</a>
        </div>
    </div>        

<?php
    pageBottom();
?>
