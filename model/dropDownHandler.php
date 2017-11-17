<?php

include_once "database.php";

$var = input("maker");
if($var !== ""){
    $carTypes = sqlGetCarswithFilter($var);
    while ($type = $carTypes->fetch_assoc()) {
//        echo '<option value='.$type['make'].'>'.$type['make'].'</option>';
    }
}
/**
 * Created by IntelliJ IDEA.
 * User: mfb15135
 * Date: 17/11/2017
 * Time: 15:20
 */
