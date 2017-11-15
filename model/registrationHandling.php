<?php
/**
 * Created by IntelliJ IDEA.
 * User: mfb15135
 * Date: 15/11/2017
 * Time: 11:27
 */
include_once "database.php";

$username    = input("username");
$name        = input("name");
$passnew     = input("password");
$passconfirm = input("confirmPassword");
$dln         = input("DLNumber");

if($dln === "" || $passconfirm === "" || $passnew === "" || $username === "" || $name !== ""){//TODO replace the name in the forum

}else if($passnew !== $passconfirm){

}else{
    insertUser($username, $passnew, $name, $dln, 1);
}


function input($field){
    return mysqli_real_escape_string(strip_tags((isset($_POST[$field]))?filter_var($_POST[$field], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ));
}
