<?php

include_once "database.php";

$var = input("maker");
$addCar = input("addCar");
//echo  "Got :".$var." At php";
if($var === "NA"){
    echo '<option value="NA">Please Select</option>';
}else if($var !== ""){

    $carTypes = sqlGetCarswithFilter($var,null);
    if($addCar === ""){
        $html = '<option value="" selected>Any</option>';
    }else{
        $html = "";
    }
    while ($type = $carTypes->fetch_assoc()) {
        $varb = $html.'<option value='.$type['model'].'>'.$type['model'].'</option>';
        $html = $varb;
    }
    echo $html;
}else{
    echo '<option value="" selected>Any</option>';
}
