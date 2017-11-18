<?php
session_start();
include_once "~../../../model/database.php";
$successfulLogin = False;

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
            $sql = "Insert into `User` (`username`, `password`) VALUES (?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $password = md5($password);
                $stmt->bind_param("ss", $username, $password);
                $successfulRegistration = $stmt->execute();
            } else {

            }
        }
        if ($successfulRegistration) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
        }
    }

    //Otherwise for login...
    //if it wasn't set, let's attempt to set login info. no effect if no user/pass
    else {
        //Do login
        $password = isset($_POST['password']) ? filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "";
        $username = isset($_POST['username']) ? filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "";
        $successfulLogin = $password != "" && $username != "";

        if ($successfulLogin) {
            $_SESSION['password'] = md5($password);
            $_SESSION['username'] = $username;
        }
    }
}

//Check if login details are available
if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['password']) && isset($_SESSION['username'])) {
    //Do login
    $successfulLogin = False;
    $sql = "SELECT * FROM `User` WHERE `username`= ? and `password` = ?";
    $password = filter_var($_SESSION['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_SESSION['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($stmt = $conn->prepare($sql)) {
        if ($stmt->bind_param("ss", $username, $password)) {
            if ($successfulLogin = $stmt->execute()) {
                $successfulLogin = $stmt->get_result()->num_rows > 0;
            }
        }
    }
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--Load bootstrap's style sheet. It includes an opinionated reboot.-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!--Load our own style sheet for this page-->
    <link rel="stylesheet" href="~../../../css/index.css">
    <!--A viewport specifies how much of the page can be seen. Allows easy resizing-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!--needed for panels to work-->

    <!--needed for panels to work-->
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

<!--Title-->
<div class="jumbotron text-center bg-dark text-light item" id="title">
    <h1> Bargain Rust Bucket</h1>
    <h6 id="small"> Insurance not included.</h6>
</div>

<div class="container">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin tools
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="addCar.php">Add car</a>
                        <a class="dropdown-item" href="addCarType.php">Add car type</a>
                        <a class="dropdown-item" href="addLocation.php">Add location</a>
                    </div>
                </li>
            </ul>
            <a data-target="#register_box" class="nav-link menu_item" role="tab" data-toggle="modal">Register</a>
            <a data-target="#login_box" class="nav-link menu_item" role="tab" data-toggle="modal">Login</a>
    </nav>

    <?php
    include_once "modals/registration_modal.php";
    ?>

    <?php
    include_once "modals/login_modal.php";
    ?>

