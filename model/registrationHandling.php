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
    //TODO alert the user as something has gone wrong
}else if($passnew !== $passconfirm){
    //TODO Do the alert for the password verification
}else{
    insertUser($username, $passnew, $name, $dln, 1);
}


