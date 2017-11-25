<?php
include_once "database.php";
$loc    = input("location");
$make   = input("make");
$model = input("model");

if($loc !== "" && $make !== "" && $model !== ""){
    $response = getTypeFromMakeAndModel($make, $model);
    $row = $response->fetch_assoc();
    insertCar($loc, $row['typeid']);
    echo "Success";
}else{
    echo "Failure";
}

