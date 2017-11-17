<?php
include_once "database.php";
$loc    = input("location");
$type   = input("type");
$img    = input("image");


if($loc === "" || $type === "" || $img === "") {
    //TODO ERROR Message
}else if(!is_numeric($loc)){
    //TODO Location is not an int
}else if(!is_numeric($type)){
    //TODO Type is not an int
} else if (!validate("Location", "locationid", $loc)){
    //TODO INvalid location
} else if (!validate("TypesOfCar", "typeid", $type)){
    //TODO INvalid type
} else {
    insertCar($loc, $type, $img);
}


