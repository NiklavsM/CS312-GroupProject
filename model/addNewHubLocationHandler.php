<?php
$name        = input("name");
$postc       = input("postcode");
$phonenumber = input("phoneNumber");
if($name === "" || $phonenumber === "" || $postc === ""){
    //TODO not allow invalid input response
} else if(!is_numeric($phonenumber)){
    //TODO is numeric
} else {
    insertLocation($name, $postc, $phonenumber);
}
