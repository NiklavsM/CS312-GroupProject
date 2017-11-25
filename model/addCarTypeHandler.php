<?php

include_once "database.php";

$comp  = input("make");
$model = input("model");
$price = input("price");

if($comp !== "" && $model !== "" && $price !== ""){
    insertCarType(strtoupper($comp), $model,$price);
    echo "Success";
}else{
    echo "Failure";
}

