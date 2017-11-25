<?php
include_once "database.php";

$name        = input("name");
$postc       = input("postcode");
$phonenumber = input("phoneNumber");

if($name !== "" && $phonenumber !== "" && $postc !== "") {
    insertLocation($name, $postc, $phonenumber);
    echo "Success";
}else{
    echo "Failure";
}
