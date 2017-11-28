<?php
include_once "database.php";

$name        = input("name");
$postc       = input("postcode");
$phonenumber = input("number");

if($name !== "" && $phonenumber !== "" && $postc !== "") {
    $result = insertLocation($name, $postc, $phonenumber);
    if($result === ""){
        echo "Success";
    }else if(strpos($result, 'phonenumber')){
        echo "That phone number has been used for another location.";
    }else if(strpos($result, 'postcode')){
        echo "That post code has been used for another location.";
    }
}else{
    echo "Failure";
}
