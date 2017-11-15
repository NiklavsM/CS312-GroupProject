<?php
include_once "database.php";
$loc    = input("location");
$type   = input("type");
$img    = input("image");
$colour = input("colour");


if($loc === "" || $type === "" || $img === "" || $colour === ""){
    //TODO ERROR Message
} else if (validate("Location", "locationid", $loc)){
    //TODO INvalid location
} else if (validate("TypesOfCar", "typeid", $type)){
    //TODO INvalid type
} else {
    insertCar($loc, $type, $img, $colour);
}


