<?php
session_start();
include_once "database.php";
$successfulLogin=False;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $password="";
    $username="";
    $confirmPassword="";

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
                $password=md5($password);
                $stmt->bind_param("ss", $username,$password  );
                $successfulRegistration = $stmt->execute();
            } else {

            }
        }
        if ($successfulRegistration) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
        }
    }

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
    <!--Load bootstrap's style sheet. It includes an opinionated reboot.-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!--Load our own style sheet for this page-->
    <link rel="stylesheet" href="../css/index.css">
    <!--A viewport specifies how much of the page can be seen. Allows easy resizing-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

<!-- Navigation menu !-->

<div class="row" , id="main_text">
    <button class="btn btn-info btn-lg menu_item" href="index.php"> Home</
    >
    <button type="button" class="btn btn-info btn-lg menu_item" data-toggle="modal" data-target="#register_box">
        Register
    </button>
    <button type="button" class="btn btn-info btn-lg menu_item" data-toggle="modal" data-target="#login_box">Login
    </button>
</div>


<!--Title-->
<div class="jumbotron text-center" id="title">
    <h1> Bargain Rust Bucket</h1>
    <h6 id="small"> Insurance not included.</h6>
</div>

<!-- Modal -->
<div id="register_box" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST" action="" novalidate="novalidate">
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="" required=""
                               title="Please enter you username" placeholder="example@gmail.com">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" required=""
                               title="Please enter your password" placeholder="Password">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                               required="" title="Please confirm your psasword" placeholder="Confirm password">
                        <span class="help-block"></span>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="login_box" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id=" loginForm" method="POST" action="">
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="" required=""
                               title="Please enter you username" placeholder="example@gmail.com">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" required=""
                               title="Please enter your password" placeholder="Password">
                        <span class="help-block"></span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" id="remember"> Remember login
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                    <a href="" class="btn btn-default btn-block">Forgotten password</a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
