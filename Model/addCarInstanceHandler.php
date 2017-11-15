<?php
include_once "database.php";
$loc    = input("location");
$type   = input("type");
$img    = input("image");
$colour = input("colour");


if($loc === "" || $type === "" || $img === "" || $colour === ""){
    //TODO ERROR Message
} else if ()

insertCar($loc, $type, $img, $colour);

function input($field){
    return mysqli_real_escape_string(strip_tags((isset($_POST[$field]))?filter_var($_POST[$field], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ));
}
