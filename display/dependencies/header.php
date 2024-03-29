<?php
session_start();
include "~../../../model/database.php";
$successfulLogin = False;
function errorMessageToDisplay($something){
    echo "<div class='panel panel-info'>$something</div>";
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $password = "";
    $username = "";
    $confirmPassword = "";

    //If user wants to register
    //confirmPassword will only be set if the user tried to register
    if (isset($_POST['confirmPassword'])) {

        //Do registration
        $password = isset($_POST['password']) ? filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "";
        $confirmPassword = isset($_POST['confirmPassword']) ? filter_var($_POST['confirmPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "";
        $username = isset($_POST['username']) ? filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "";
        $successfulRegistration = $confirmPassword == $password;

        if ($password != "" && $username != "" && $successfulRegistration) {
            if (addNewUser($username, $password)) {
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $successfulLogin = true;
            } else {
                errorMessageToDisplay("error there is already a username with that name");
            }
        } else {
            errorMessageToDisplay("The application was unsuccessful with [$password, $username, $confirmPassword]");
        }
    }


//Otherwise for login...
//if it wasn't set, let's attempt to set login info. no effect if no user/pass
    else {
        if (isset($_POST['loginPassWord'])) {
            //Do login
            $password = isset($_POST['loginPassWord']) ? filter_var($_POST['loginPassWord'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "";
            $username = isset($_POST['loginUserName']) ? filter_var($_POST['loginUserName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "";
            if ($password != "" && $username != "") {
                if (checkLogin($username, $password)) {
                    $_SESSION['password'] = $password;
                    $_SESSION['username'] = $username;
                    $successfulLogin = true;
                } else {
                    errorMessageToDisplay("Incorrect Password Username combination");
                }
            }
        }
    }
}

//Check if login details are available
if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['password']) && isset($_SESSION['username'])) {
    //Do login
    $successfulLogin = False;

    $password = filter_var($_SESSION['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_SESSION['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (checkLogin($username, $password)) {
        $successfulLogin = true;
    } else {
        errorMessageToDisplay("Oops session has expired");
        $successfulLogin = false;
        session_destroy();
    }
} ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    <script>
        webshims.setOptions('forms-ext', {types: 'dates'});
        webshims.polyfill('forms forms-ext');
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--Load bootstrap's style sheet. It includes an opinionated reboot.-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!--Load our own style sheet for this page-->
    <link rel="stylesheet" href="~../../../css/index.css">
    <!--A viewport specifies how much of the page can be seen. Allows easy resizing-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!--needed for panels to work-->
    <!-- cdn for modernizr, if you haven't included it already -->

    <!--needed for panels to work-->
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
<div class="container">
    <!--Title-->
    <div class="text-center bg-dark text-light item" id="title">
        <h1> Bargain Rust Bucket</h1>
        <h6 id="small"> Insurance not included.</h6>
    </div>


    <!-- Navigation menu !-->
    <!--    <nav class="navbar navar-expand-md navbar-dark bg-dark text-light item">-->
    <!--        <div>-->
    <!--            <a class="menu_item menu_button" href="index.php">Home</a>-->
    <!--            <a  class="menu_item menu_button"href="cars.php">Cars</a>-->
    <!--            <a  class="menu_item menu_button"href="addCar.php">Add car</a>-->
    <!--        </div>-->
    <!---->
    <!--        <div>-->
    <!--            <a data-target="#register_box" class="menu_item menu_button2" role="tab" data-toggle="modal">Register</a>-->
    <!--            <a data-target="#login_box" class=" menu_item menu_button2" role="tab" data-toggle="modal">Login</a>-->
    <!--        </div>-->
    <!---->
    <!--    </nav>-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cars.php">Cars</a>
            </li>
            <?php
            if (isset($_SESSION['username'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="userReservations.php">Reservations</a>
                </li>

                <?php
            }
            if (isset($_SESSION['username']) && getUserRights($_SESSION['username'])>0) {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        Admin tools
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="addActionsContainer.php">Add Field</a>
                        <a class="dropdown-item" href="carsInLocations.php">View Cars At Locations</a>
                        <a class="dropdown-item" href="manageReservations.php">Manage User Reservations</a>
                    </div>
                </li>
                <?php
            }
            ?>

        </ul>
        <?php
        if (!isset($_SESSION['username'])) {
            ?>
            <a data-target="#register_box" class="nav-link menu_item" role="tab" data-toggle="modal">Register</a>
            <a data-target="#login_box" class="nav-link menu_item" role="tab" data-toggle="modal">Login</a>
            <?php
        } else {
            echo "<p>Logged in as ".$_SESSION['username']."</p>";
            if(getUserRights($_SESSION['username'])>0){
                echo "<p>, in admin mode</p>";
            }
            ?>
            <ul class="nav-link menu_item">
                    <a class="nav-link" href="logOut.php">Log Out</a>
            </ul>
        <?php
        }
        ?>
    </nav>

    <?php
    if (!isset($_SESSION['username'])) {
        include_once "modals/registration_modal.php";
    }
    ?>

    <?php
    if (!isset($_SESSION['username'])) {
        include_once "modals/login_modal.php";
    } ?>

