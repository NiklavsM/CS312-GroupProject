<?php

include_once "database.php";

$var = input("make");
$addCar = $var == "";
$html = "";

//echo  "Got :".$var." At php";
if ($var === "") {
    echo '<option value="">Any</option>';
} else if ($addCar === "" && $var === "") {
    $html = '<option value="" selected>Any</option>';
} else if ($var !== "") {

    $carTypes = sqlgetCarTypesFromInstance($var);


    while ($type = $carTypes->fetch_assoc()) {

        $html = $html . '<option value="' . $type['model'] . '">' . $type['model'] . '</option>';

    }

    $html = '<option value="">Any</option>' . $html;
    echo $html;
}
