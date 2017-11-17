<?php

include_once "database.php";

$var = input("maker");
//echo  "Got :".$var." At php";
if($var === "NA"){
    echo '<option value="NA">Please Select</option>';
}else if($var !== ""){

    $carTypes = sqlGetCarswithFilter($var,null);
    $html = "";
    while ($type = $carTypes->fetch_assoc()) {
        $varb = $html.'<option value='.$type['model'].'>'.$type['model'].'</option>';
        $html = $varb;
    }
    echo $html;
}
/**
 * Created by IntelliJ IDEA.
 * User: mfb15135
 * Date: 17/11/2017
 * Time: 15:20
 */
